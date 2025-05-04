<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;

class MemoryController extends Controller
{
    /**
     * Display a listing of the memories.
     */
    public function index()
    {
        $memories = Memory::where('user_id', auth()->id())->get();
        return view('memories.index', compact('memories'));
    }

    /**
     * Show the form for creating a new memory.
     */
    public function create()
    {
        return view('memories.create');
    }

    /**
     * Store a newly created memory in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Memory::create([
            ...$validated,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('memories.index')
            ->with('success', 'Memory created successfully!');
    }

    /**
     * Display the specified memory.
     */
    public function show(Memory $memory)
    {
        return view('memories.show', compact('memory'));
    }

    /**
     * Show the form for editing the specified memory.
     */
    public function edit(Memory $memory)
    {
        return view('memories.edit', compact('memory'));
    }

    /**
     * Update the specified memory in storage.
     */
    public function update(Request $request, Memory $memory)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $memory->update($validated);

        return redirect()->route('memories.index')
            ->with('success', 'Memory updated successfully!');
    }

    /**
     * Remove the specified memory from storage.
     */
    public function destroy(Memory $memory)
    {
        $memory->delete();
        return redirect()->route('memories.index')
            ->with('success', 'Memory deleted successfully!');
    }
}
