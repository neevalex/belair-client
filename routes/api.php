<?php

use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;


    Route::get('/invoice-events', [DashboardController::class, 'events'])
    ->middleware(['auth', 'client'])
    ->name('api.invoice-events');


