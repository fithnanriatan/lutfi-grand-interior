<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Landing\ServiceController;
use App\Http\Controllers\Landing\PorfoliosController;
use App\Http\Controllers\Landing\KontakController;

// Landing page (public)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/services', [ServiceController::class, 'index'])->name('services'); // Halaman List
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show'); // Halaman Detail
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Rute Halaman Daftar Portfolio
Route::get('/portfolios', [PorfoliosController::class, 'index'])->name('portfolios.index');
Route::get('/portfolios/detail/{id}', [PorfoliosController::class, 'show'])->name('portfolios.show');

// Review form (public, via unique link)
Route::get('/review/{token}', [ReviewController::class, 'showForm'])->name('review.form');
Route::post('/review/{token}', [ReviewController::class, 'submitForm'])->name('review.submit');

// Guest routes (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Admin routes (sudah login)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('layanan', LayananController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('portfolio', PortfolioController::class);

    // Review routes
    Route::get('review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review/{review}/toggle', [ReviewController::class, 'toggleTampilkan'])->name('review.toggle');
    Route::delete('review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // Portfolio extra routes
    Route::post('portfolio/{portfolio}/toggle', [PortfolioController::class, 'toggleTampilkan'])->name('portfolio.toggle');
    Route::delete('portfolio/{portfolio}/gallery/{index}', [PortfolioController::class, 'deleteGalleryImage'])->name('portfolio.deleteGalleryImage');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
