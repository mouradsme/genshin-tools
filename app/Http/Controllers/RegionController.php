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
        $region->load('worldQuests');
        return view('regions.show', compact('region'));
    }
} 