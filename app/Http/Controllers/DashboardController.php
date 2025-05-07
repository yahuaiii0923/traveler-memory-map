<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Memory;
use App\Models\Photo;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetching statistics
        $usersCount = User::count();
        $memoriesCount = Memory::count();
        $photosCount = Photo::count();

        // Counting distinct countries if the column exists
        if (\Schema::hasColumn('memories', 'location_name')) {
            $countriesCount = Memory::distinct('location_name')->count();
        } else {
            $countriesCount = 0;
        }

        // Fetching recent memories (last 5 added)
        $recentMemories = Memory::latest()->take(5)->get();

        // Preparing the stats array
        $stats = [
            'users' => $usersCount,
            'memories' => $memoriesCount,
            'photos' => $photosCount,
            'countries' => $countriesCount,
        ];

        return view('dashboard', compact('stats', 'recentMemories'));
    }
}
