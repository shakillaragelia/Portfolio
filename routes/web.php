<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;

// ── Halaman utama (single-page scrolling)
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// ── Form kontak 
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ── Komentar
Route::post('/comment', [ContactController::class, 'comment'])->name('comment.store');
