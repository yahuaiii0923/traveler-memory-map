<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'googleMapsApiKey' => env('GOOGLE_MAPS_API_KEY'),
            'testimonials' => [
                [
                    'name' => 'Sarah Johnson',
                    'role' => 'Digital Nomad',
                    'text' => '"This platform transformed how I document my travels!"',
                    'metric' => '42 Countries Documented'
                ],
                [
                    'name' => 'Michael Chen',
                    'role' => 'Travel Photographer',
                    'text' => '"The best travel journal platform I\'ve used."',
                    'metric' => '1,200+ Memories Created'
                ]
            ],
            'stats' => [
                'memories' => '75K+',
                'countries' => '164',
                'photos' => '1.2M'
            ]
        ]);
    }
}
