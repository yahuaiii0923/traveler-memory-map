<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'role' => 'nullable|string|max:255',
            'metric' => 'nullable|string|max:255',
        ]);

        // Get the authenticated user's name and username
        $userName = auth()->user()->name;
        $username = auth()->user()->username;

        Testimonial::create([
            'name' => $userName,
            'username' => $username, // Ensure this line is present
            'role' => $request->role,
            'text' => $request->text,
            'metric' => $request->metric,
            'is_public' => true,
        ]);

        return redirect()->route('home')->with('success', 'Thank you for your testimonial!');
    }

    public function index()
    {
        // Fetch all public testimonials from the database
        $testimonials = Testimonial::where('is_public', true)->latest()->get();

        return view('testimonials.index', compact('testimonials'));
    }
}
