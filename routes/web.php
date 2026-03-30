<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Single page — semua section tampil di satu halaman
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// Contact form + comment submit
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/comment', [ContactController::class, 'comment'])->name('comment.store');

/*
|--------------------------------------------------------------------------
| Admin pakai Filament — auto generate di /admin
|--------------------------------------------------------------------------
| Install:
|   composer require filament/filament:"^3.0" -W
|   php artisan filament:install --panels
|   php artisan make:filament-user
|
| Buat Resources:
|   php artisan make:filament-resource Project --generate
|   php artisan make:filament-resource Message --generate
|   php artisan make:filament-resource Comment --generate
|   php artisan make:filament-resource Setting --generate
*/