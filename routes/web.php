<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });

    Route::middleware('role:buyer')->group(function () {
        Route::get('/dashboard', function () {
            return 'Buyer Dashboard';
        })->name('buyer.dashboard');
    });
});
