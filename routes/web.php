<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.attempt');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Authenticated routes — both admin and staff
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('donors', DonorController::class);
    Route::resource('causes', CauseController::class)->except(['destroy']);
    Route::resource('donations', DonationController::class)->except(['show']);

    Route::get('/donations/{donation}/receipt', [ReceiptController::class, 'show'])->name('receipts.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/donor-wise', [ReportController::class, 'donorWise'])->name('reports.donor-wise');
    Route::get('/reports/cause-wise', [ReportController::class, 'causeWise'])->name('reports.cause-wise');
    Route::get('/reports/mode-wise', [ReportController::class, 'modeWise'])->name('reports.mode-wise');
    Route::get('/reports/category-wise', [ReportController::class, 'categoryWise'])->name('reports.category-wise');
    Route::get('/reports/date-wise', [ReportController::class, 'dateWise'])->name('reports.date-wise');
});

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/causes/{cause}', [CauseController::class, 'destroy'])->name('causes.destroy');
    Route::resource('users', UserController::class)->except(['show']);
});
