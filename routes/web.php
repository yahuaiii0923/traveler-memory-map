<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DashboardController;

// Main route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/map', [MapController::class, 'index'])->name('map');

// Authentication routes (now provided by laravel/ui)
Auth::routes();

// Memory resource routes
Route::resource('memories', MemoryController::class);
Route::get('/memories/{memory}', [MemoryController::class, 'show'])->name('memories.show');


Route::get('/test-auth', function () {
    return Auth::check() ? 'User is logged in: '.Auth::user()->name : 'Not logged in';
});

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', function (Request $request) {
    return redirect()->back()->with('message', 'Your message has been sent!');
})->name('contact.submit');
Route::view('/privacy', 'privacy')->name('privacy');

