<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ReviewController;

// Landing page (public)
Route::get('/', function () {
    return view('landing');
})->name('landing');

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
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
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