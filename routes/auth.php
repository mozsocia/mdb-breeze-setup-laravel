<?php

use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\Auth\LoginRegContorller;
use App\Http\Controllers\Auth\PasswordAllController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [LoginRegContorller::class, 'reg_create'])
        ->name('register');

    Route::post('register', [LoginRegContorller::class, 'reg_store']);

    Route::get('login', [LoginRegContorller::class, 'login_create'])
        ->name('login');

    Route::post('login', [LoginRegContorller::class, 'login_store']);

    Route::get('forgot-password', [PasswordAllController::class, 'forgot_create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordAllController::class, 'forgot_store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [PasswordAllController::class, 'reset_create'])
        ->name('password.reset');

    Route::post('reset-password', [PasswordAllController::class, 'reset_store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerifyController::class, 'notice'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [EmailVerifyController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerifyController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [LoginRegContorller::class, 'destroy'])
        ->name('logout');
});

// Route::get('/dashboard', function () {
//     return view('frontend.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('password', [ProfileController::class, 'password_update'])->name('password.update');
});
