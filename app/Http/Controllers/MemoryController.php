<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;

class MemoryController extends Controller
{
    public function index()
    {
        $memories = Memory::all(); // Fetch all memories
        return view('memories.index', ['memories' => $memories]);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // Associate with logged-in user
    $validated['user_id'] = auth()->id();

    Memory::create($validated);

    return redirect()->route('memories.index')->with('success', 'Memory saved!');
}
}
