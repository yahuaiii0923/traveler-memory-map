<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemoryController;

// Public routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Keep your existing memories resource route
Route::resource('memories', MemoryController::class)->middleware('auth');

// Add this map route
Route::get('/map', function () {
    return view('map');
})->name('map');

// Authentication routes
Route::middleware('guest')->group(function () {
    require __DIR__.'/auth.php';
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::resource('memories', MemoryController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
