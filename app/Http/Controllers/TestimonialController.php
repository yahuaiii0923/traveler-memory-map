<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_public', true)->latest()->paginate(12);
        return view('testimonials.index', compact('testimonials'));
    }
    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'text' => 'required|string',
            'metric' => 'nullable|string|max:255',
        ]);

        Testimonial::create([
            'name' => $request->name,
            'role' => $request->role,
            'text' => $request->text,
            'metric' => $request->metric,
            'is_public' => true, // make all submissions public
        ]);

        return redirect()->route('home')->with('success', 'Thank you for your testimonial!');
    }
}
