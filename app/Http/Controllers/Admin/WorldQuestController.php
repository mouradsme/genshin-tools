<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorldQuest;
use App\Models\Region;
use Illuminate\Http\Request;

class WorldQuestController extends Controller
{
    public function index()
    {
        $worldQuests = WorldQuest::with('region')->get();
        return view('admin.world-quests.index', compact('worldQuests'));
    }

    public function create(Request $request)
    {
        $regions = Region::all();
        $selectedRegionId = $request->get('region_id');
        return view('admin.world-quests.create', compact('regions', 'selectedRegionId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'region_id' => 'required|exists:regions,id',
            'guide_link' => 'required|url',
        ]);

        WorldQuest::create($validated);

        return redirect()->route('admin.world-quests.index')
            ->with('success', 'World Quest created successfully.');
    }

    public function edit(WorldQuest $worldQuest)
    {
        $regions = Region::all();
        return view('admin.world-quests.edit', compact('worldQuest', 'regions'));
    }

    public function update(Request $request, WorldQuest $worldQuest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'region_id' => 'required|exists:regions,id',
            'guide_link' => 'required|url',
        ]);

        $worldQuest->update($validated);

        return redirect()->route('admin.world-quests.index')
            ->with('success', 'World Quest updated successfully.');
    }

    public function destroy(WorldQuest $worldQuest)
    {
        $worldQuest->delete();

        return redirect()->route('admin.world-quests.index')
            ->with('success', 'World Quest deleted successfully.');
    }
} 