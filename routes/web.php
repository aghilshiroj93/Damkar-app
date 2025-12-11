<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\PetugasController;

// ➤ Redirect otomatis ke login ketika akses '/'
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Auth (login/logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (pakai middleware)
Route::middleware(['auth.petugas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('petugas', PetugasController::class)->except(['show']);
    Route::resource('kejadian', KejadianController::class);
});
