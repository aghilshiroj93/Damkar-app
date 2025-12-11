<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\PetugasController;

// Auth (login/logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (pakai middleware)
Route::middleware(['auth.petugas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // resource yang butuh proteksi:
    Route::resource('petugas', PetugasController::class)->except(['show']);
    Route::resource('kejadian', KejadianController::class);
});

// Jika ingin halaman kejadian tetap publik, pindahkan resource kejadian keluar dari group middleware.
