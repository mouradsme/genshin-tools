<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\WorldQuest;
use App\Models\UserQuest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get active quests (not completed)
        $activeQuests = auth()->user()->trackedQuests()
            ->with(['worldQuest.region'])
            ->whereIn('status', ['not_started', 'in_progress'])
            ->get();

        // Calculate quest statistics
        $stats = [
            'total' => auth()->user()->trackedQuests()->count(),
            'completed' => auth()->user()->trackedQuests()->where('status', 'completed')->count(),
            'in_progress' => auth()->user()->trackedQuests()->where('status', 'in_progress')->count(),
        ];
        
        return view('dashboard', compact('activeQuests', 'stats'));
    }
} 