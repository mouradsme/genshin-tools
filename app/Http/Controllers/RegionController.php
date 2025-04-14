<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function show(Region $region)
    {
        $region->load(['worldQuests.userQuests' => function($query) {
            $query->where('user_id', auth()->id());
        }]);
        return view('regions.show', compact('region'));
    }
} 