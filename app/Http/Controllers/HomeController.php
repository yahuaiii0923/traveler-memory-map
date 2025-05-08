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
        $testimonials = Testimonial::select('testimonials.*')
            ->where('testimonials.is_public', 1)
            ->latest()
            ->limit(3)
            ->get();

        $stats = [
            'users' => User::count(),
            'memories' => Memory::count(),
            'countries' => Memory::distinct('location_name')->count(),
            'photos' => Photo::count(),
        ];

        return view('home', compact('stats', 'testimonials'));
    }
}
