<?php

namespace App\Http\Controllers;

use App\Models\WorldQuest;
use Illuminate\Http\Request;

class WorldQuestController extends Controller
{
    public function index()
    {
        $worldQuests = WorldQuest::with('region')->get();
        return view('world-quests.index', compact('worldQuests'));
    }

    public function show(WorldQuest $worldQuest)
    {
        $worldQuest->load('region');
        return view('world-quests.show', compact('worldQuest'));
    }
} 