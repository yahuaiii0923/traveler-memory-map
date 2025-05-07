<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;
use App\Models\Photo;

class MemoryController extends Controller
{
    public function index()
    {
        $allMemories = Memory::with('photos')->get();

        $memories = $allMemories->map(function ($memory) {
            return [
                'title' => $memory->title,
                'description' => $memory->description,
                'photos' => $memory->photos->pluck('file_path'),
                'location_name' => $memory->location_name,
                'rating' => $memory->rating,
                'latitude' => $memory->latitude,
                'longitude' => $memory->longitude,
                'created_at' => $memory->created_at->toDateTimeString(),
            ];
        });

        $years = $allMemories->pluck('created_at')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->year)
            ->unique()
            ->sort()
            ->values();

        return view('memories.index', [
            'memories' => $memories,
            'years' => $years
        ]);
    }

    public function create()
    {
        return view('memories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photos.*' => 'nullable|image|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $memory = Memory::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location_name' => $validated['location_name'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'rating' => $validated['rating'],
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('memories', 'public');
                $memory->photos()->create(['file_path' => $path]);
            }
        }

        return redirect()->route('memories.index')->with('success', 'Memory saved!');
    }
