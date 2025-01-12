<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Underdevelopment;

// Open Routes
Route::redirect('/', '/website-under-development', 301)->name('home');
Route::get('/website-under-development', Underdevelopment::class)->name('development');
