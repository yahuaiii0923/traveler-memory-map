<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;

class MemoryController extends Controller
{
    public function index()
    {
        $memories = Memory::all();

        // Group by creation year
        $groupedMemories = $memories->groupBy(function ($memory) {
            return $memory->created_at->year;
        })->sortKeysDesc();

        return view('memories.index', [
            'memories' => $memories,
            'groupedMemories' => $groupedMemories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|image|max:2048', // 2MB max
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('memories', 'public');
            $validated['photo'] = $path;
        }

        $validated['user_id'] = auth()->id();
        Memory::create($validated);

        return redirect()->route('memories.index')->with('success', 'Memory saved!');
    }
public function create()
{
    return view('memories.create');
}
}
