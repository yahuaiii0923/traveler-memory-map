<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'text' => 'required|string',
            'metric' => 'nullable|string|max:255',
            'memory_slug' => 'nullable|string|max:255',
            'is_public' => 'sometimes|boolean',
        ]);

        Testimonial::create($validated);

        return redirect()->route('home')->with('success', 'Testimonial added!');
    }
}
