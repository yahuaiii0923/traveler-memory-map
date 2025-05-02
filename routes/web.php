<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemoryController;

// Public routes (e.g., welcome page)
Route::get('/', function () {
    return redirect()->route('memories.index');
})->name('home');

// Authentication routes (login, register, etc.)
Route::middleware('guest')->group(function () {
    require __DIR__.'/auth.php';
});

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Memories CRUD
    Route::resource('memories', MemoryController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard (optional)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
