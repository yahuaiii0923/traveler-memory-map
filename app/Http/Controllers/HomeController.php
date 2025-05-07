<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Memory;
use App\Models\Photo;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
        {
            // Counting users, memories, and photos
            $usersCount = User::count();
            $memoriesCount = Memory::count();
            $photosCount = Photo::count();

            // Safely count countries if the column exists
            if (Schema::hasColumn('memories', 'location_name')) {
                $countriesCount = Memory::distinct('location_name')->count();
            } else {
                $countriesCount = 0;
            }

            // Fetching testimonials only from registered users
            $testimonials = Testimonial::join('users', 'testimonials.user_id', '=', 'users.id')
                            ->select('testimonials.*', 'users.username')
                            ->where('testimonials.is_public', 1)
                            ->latest()
                            ->limit(3)
                            ->get();

            // Compiling the stats and testimonials
            $stats = [
                'users' => $usersCount,
                'memories' => $memoriesCount,
                'countries' => $countriesCount,
                'photos' => $photosCount,
            ];

            return view('home', compact('stats', 'testimonials'));
        }
}
