<?php

use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\User\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
], function() {
    Route::post('create', [RegisterUserController::class, 'store'])->name('register');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::group([
        'middleware' => 'jwt.verify',
    ], function() {
        Route::get('', [RegisterUserController::class, 'index'])->name('index');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

});

