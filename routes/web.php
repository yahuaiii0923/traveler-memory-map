<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\TestimonialController;

// Main route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/map', [MapController::class, 'index'])->name('map');

// Authentication routes (now provided by laravel/ui)
Auth::routes();

// Memory resource routes
Route::resource('memories', MemoryController::class);

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
