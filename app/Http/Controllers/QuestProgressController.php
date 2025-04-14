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
        // Try to find existing quest tracking
        $userQuest = auth()->user()->trackedQuests()
            ->where('world_quest_id', $worldQuest->id)
            ->first();

        if ($userQuest) {
            // If quest is already being tracked, just update its status
            $userQuest->update(['status' => 'completed']);
            $message = 'Quest marked as completed.';
        } else {
            // If quest is not being tracked, create new entry
            auth()->user()->trackedQuests()->create([
                'world_quest_id' => $worldQuest->id,
                'status' => 'completed'
            ]);
            $message = 'Quest added and marked as completed.';
        }

        return back()->with('success', $message);
    }

    public function update(UserQuest $userQuest, Request $request)
    {
        $userQuest->update(['status' => 'completed']);
        return back()->with('success', 'Quest marked as completed.');
    }

    public function destroy(UserQuest $userQuest)
    {
        $userQuest->delete();
        return back()->with('success', 'Quest removed.');
    }

    public function batchUpdate(Request $request)
    {
        $validated = $request->validate([
            'selected_quests' => 'required|array',
            'selected_quests.*' => 'exists:user_quests,id',
            'action' => 'required|in:complete,remove'
        ]);

        $userQuests = UserQuest::whereIn('id', $validated['selected_quests'])
            ->where('user_id', auth()->id())
            ->get();

        $count = 0;
        foreach ($userQuests as $userQuest) {
            if ($validated['action'] === 'complete') {
                $userQuest->update(['status' => 'completed']);
            } else {
                $userQuest->delete();
            }
            $count++;
        }

        $action = $validated['action'] === 'complete' ? 'completed' : 'removed';
        return back()->with('success', "{$count} quests {$action} successfully.");
    }

    public function batchStore(Request $request)
    {
        $validated = $request->validate([
            'selected_quests' => 'required|array',
            'selected_quests.*' => 'exists:world_quests,id'
        ]);

        $count = 0;
        foreach ($validated['selected_quests'] as $questId) {
            // Check if quest is already being tracked
            $exists = auth()->user()->trackedQuests()
                ->where('world_quest_id', $questId)
                ->exists();

            if (!$exists) {
                auth()->user()->trackedQuests()->create([
                    'world_quest_id' => $questId,
                    'status' => 'completed'
                ]);
                $count++;
            }
        }

        return back()->with('success', "{$count} quests marked as completed.");
    }
} 