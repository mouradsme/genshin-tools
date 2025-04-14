<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\WorldQuest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        $worldQuests = WorldQuest::with('region')->get();
        
        return view('dashboard', compact('regions', 'worldQuests'));
    }
} 