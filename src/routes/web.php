<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\HomePage;
use App\Livewire\ContactPage;
use App\Livewire\ProjectPage;
use App\Livewire\ProjectDetail;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

Route::get('/', HomePage::class)->name('home');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/projects', ProjectPage::class)->name('projects');
Route::get('/projects/{project}', ProjectDetail::class)->name('projects.detail');
