<?php

namespace App\Http\Controllers;

use App\Models\UserQuest;
use App\Models\WorldQuest;
use Illuminate\Http\Request;

class QuestProgressController extends Controller
{
    public function index()
    {
        $userQuests = auth()->user()->trackedQuests()
            ->with(['worldQuest.region'])
            ->get()
            ->groupBy('status');

        $availableQuests = WorldQuest::whereDoesntHave('userQuests', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('region')->get();

        return view('quests.progress', compact('userQuests', 'availableQuests'));
    }

    public function store(WorldQuest $worldQuest)
    {
        auth()->user()->trackedQuests()->create([
            'world_quest_id' => $worldQuest->id,
            'status' => 'not_started'
        ]);

        return back()->with('success', 'Quest added to your tracking list.');
    }

    public function update(UserQuest $userQuest, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:not_started,in_progress,completed',
            'notes' => 'nullable|string'
        ]);

        $userQuest->update($validated);

        return back()->with('success', 'Quest progress updated.');
    }

    public function destroy(UserQuest $userQuest)
    {
        $userQuest->delete();

        return back()->with('success', 'Quest removed from tracking.');
    }
} 