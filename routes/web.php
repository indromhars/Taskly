<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Home Route
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Projects Routes
    Route::get('/projects', function () {
        return view('projects.index');
    })->name('projects.index');

    Route::get('/projects/create', function () {
        return view('projects.create');
    })->name('projects.create');

    Route::get('/projects/{project}', function ($project) {
        return view('projects.show', ['project' => $project]);
    })->name('projects.show');
});
