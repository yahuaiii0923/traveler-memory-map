<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;

class MemoryController extends Controller
{
   public function index()
   {
       // Step 1: Get the original full Eloquent collection
       $allMemories = Memory::all();

       // Step 2: Create a mapped version for use in JavaScript
       $memories = $allMemories->map(function ($memory) {
           return [
               'title' => $memory->title,
               'description' => $memory->description,
               'photo' => $memory->photo,
               'location_name' => $memory->location_name,
               'rating' => $memory->rating,
               'latitude' => $memory->latitude,
               'longitude' => $memory->longitude,
               'created_at' => $memory->created_at->toDateTimeString(), // ✅ format for JS
           ];
       });

       // Step 3: Group the original collection by year
       $groupedMemories = $allMemories->groupBy(function ($memory) {
           return $memory->created_at->year;
       })->sortKeysDesc();

    // Step 4: Extract unique years
        $years = $allMemories->pluck('created_at')
                                ->map(fn($date) => \Carbon\Carbon::parse($date)->year)
                                ->unique()
                                ->sort()
                                ->values();

       // Step 5: Return view with both datasets
       return view('memories.index', [
           'memories' => $memories,
           'groupedMemories' => $groupedMemories,
           'years' => $years
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