<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;
use App\Models\Photo;

class MemoryController extends Controller
{
    public function index()
    {
        $allMemories = Memory::with('photos')->get(); // eager load photos

        $memories = $allMemories->map(function ($memory) {
            return [
                'title' => $memory->title,
                'description' => $memory->description,
                'photo' => $memory->photos->first()?->file_path, // first image only
                'location_name' => $memory->location_name,
                'rating' => $memory->rating,
                'latitude' => $memory->latitude,
                'longitude' => $memory->longitude,
                'created_at' => $memory->created_at->toDateTimeString(),
            ];
        });

        $groupedMemories = $allMemories->groupBy(function ($memory) {
            return $memory->created_at->year;
        })->sortKeysDesc();

        $years = $allMemories->pluck('created_at')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->year)
            ->unique()
            ->sort()
            ->values();

        return view('memories.index', [
            'memories' => $memories,
            'groupedMemories' => $groupedMemories,
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

        $validated['user_id'] = auth()->id();

        // Create the memory once
        $memory = Memory::create($validated);

        // Save all uploaded photos (if any)
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('memories', 'public');

                Photo::create([
                    'memory_id' => $memory->id,
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('memories.index')->with('success', 'Memory saved!');
    }
}
