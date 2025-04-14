<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\WorldQuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('regions', 'public');
            $validated['cover_image'] = $path;
        }

        Region::create($validated);

        return redirect()->route('admin.regions.index')
            ->with('success', 'Region created successfully.');
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($region->cover_image) {
                Storage::disk('public')->delete($region->cover_image);
            }
            $path = $request->file('cover_image')->store('regions', 'public');
            $validated['cover_image'] = $path;
        }

        $region->update($validated);

        return redirect()->route('admin.regions.index')
            ->with('success', 'Region updated successfully.');
    }

    public function destroy(Region $region)
    {
        // Delete the cover image
        if ($region->cover_image) {
            Storage::disk('public')->delete($region->cover_image);
        }
        
        $region->delete();

        return redirect()->route('admin.regions.index')
            ->with('success', 'Region deleted successfully.');
    }

    public function show(Region $region)
    {
        $region->load('worldQuests');
        return view('admin.regions.show', compact('region'));
    }

    public function importQuests(Request $request, Region $region)
    {
        $request->validate([
            'quests_file' => 'required|file|mimes:json|max:2048'
        ]);

        try {
            $jsonContent = file_get_contents($request->file('quests_file')->path());
            $quests = json_decode($jsonContent, true);

            if (!is_array($quests)) {
                return back()->with('error', 'Invalid JSON format. Expected an array of quests.');
            }

            $imported = 0;
            $skipped = 0;

            foreach ($quests as $questData) {
                // Validate quest data structure
                if (!isset($questData['name']) || !isset($questData['link'])) {
                    continue;
                }

                // Check for existing quest with the same name
                $exists = WorldQuest::where('name', $questData['name'])
                    ->where('region_id', $region->id)
                    ->exists();

                if (!$exists) {
                    WorldQuest::create([
                        'name' => $questData['name'],
                        'description' => $questData['description'] ?? $questData['name'], // Use name as description if not provided
                        'guide_link' => $questData['link'],
                        'region_id' => $region->id
                    ]);
                    $imported++;
                } else {
                    $skipped++;
                }
            }

            return back()->with('success', "Successfully imported {$imported} quests. {$skipped} quests skipped (duplicates).");
        } catch (\Exception $e) {
            return back()->with('error', 'Error processing the JSON file: ' . $e->getMessage());
        }
    }
} 