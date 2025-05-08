<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class MemoryController extends Controller
{
    // Ensure authentication for all methods in this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index method to display all memories
    public function index()
    {
        $allMemories = Memory::with('photos')->get();

        $memories = $allMemories->map(function ($memory) {
            return [
                'id' => $memory->id,
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

        // Get the years from the memories created_at timestamps
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

    // Store method to add a new memory
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'rating' => 'nullable|integer|min:1|max:5',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple photo validation
        ]);

        // Create the memory
        $memory = Memory::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location_name' => $validated['location_name'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'rating' => $validated['rating'] ?? null,
            'user_id' => auth()->id(), // Save the user_id of the logged-in user
        ]);

        // Save the uploaded photos
        // Save the uploaded photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Store the photo in the 'public/images' directory
                $path = $photo->store('images', 'public');

                // Remove the 'public/' prefix from the stored path
                $path = str_replace('public/', '', $path);

                // Create a new photo record linked to the memory
                Photo::create([
                    'memory_id' => $memory->id,
                    'file_path' => $path, // Save the cleaned file path
                ]);
            }
        }


        // Redirect back with a success message
        return redirect()->route('memories.index')->with('success', 'Memory added successfully!');
    }


    // Create method to display the form
    public function create()
    {
        return view('memories.create');
    }

    public function show($id)
    {
        $memory = Memory::with('photos')->findOrFail($id);

        return view('memories.show', compact('memory'));
    }

}
