<?php

use SecurityTools\LaravelAccess\Http\Controllers\AccessController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'throttle:60,1'])
    ->prefix('access')
    ->namespace('access')
    ->name('access.')
    ->group(function () {
        Route::get('/', [AccessController::class, 'index'])
            ->name('index');
        Route::put('/', [AccessController::class, 'validateCode'])
            ->name('validate_code');
        Route::post('/', [AccessController::class, 'sendCode'])->name('send_code');
    });
