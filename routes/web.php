<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\MapController;

// Main route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/map', [MapController::class, 'index'])->name('map');

// Authentication routes (now provided by laravel/ui)
Auth::routes();

// Memory resource routes
Route::resource('memories', MemoryController::class);
