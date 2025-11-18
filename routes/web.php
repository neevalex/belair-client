<?php

use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// /invoices
Route::get('invoices', function () {
    return view('invoices');
})->middleware(['auth', 'verified'])->name('invoices');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/client/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
    Route::post('/client/login', [ClientAuthController::class, 'login'])->name('client.login.attempt');
});

Route::post('/client/logout', [ClientAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('client.logout');

// Minimal client dashboard to land after login
Route::get('/client/dashboard', function () {
    return view('client.dashboard');
})->middleware(['auth', 'client'])->name('client.dashboard');


require __DIR__.'/auth.php';
