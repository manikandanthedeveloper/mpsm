<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Authentication
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/auth/register',
        [AuthController::class, 'register']
    );

    Route::post(
        '/auth/login',
        [AuthController::class, 'login']
    );

    /*
    |--------------------------------------------------------------------------
    | Protected API
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        Route::get(
            '/auth/me',
            [AuthController::class, 'me']
        );

        Route::post(
            '/auth/logout',
            [AuthController::class, 'logout']
        );

    });
});
