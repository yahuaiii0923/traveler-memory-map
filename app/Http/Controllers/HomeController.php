<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'googleMapsApiKey' => env('GOOGLE_MAPS_API_KEY'),
            'testimonials' => Testimonial::where('is_public', true)->latest()->take(6)->get(),
            'stats' => [
                'memories' => '75K+',
                'countries' => '164',
                'photos' => '1.2M'
            ]
        ]);
    }
}
