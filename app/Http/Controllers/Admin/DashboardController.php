<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use App\Models\WorldQuest;
use App\Models\UserQuest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalRegions = Region::count();
        $totalWorldQuests = WorldQuest::count();
        $totalTrackedQuests = UserQuest::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRegions',
            'totalWorldQuests',
            'totalTrackedQuests'
        ));
    }
} 