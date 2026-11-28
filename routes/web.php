<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('courses', 'courses.catalog')->name('courses.index');
    Route::livewire('courses/{course}', 'courses.show')->name('courses.show');
});

require __DIR__.'/settings.php';
