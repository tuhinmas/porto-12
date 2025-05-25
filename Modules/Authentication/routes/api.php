<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\Http\Controllers\AuthenticationController;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth',
], function ($router) {
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::post('refresh', [AuthenticationController::class, 'refresh']);
    Route::post('me', [AuthenticationController::class, 'me']);
});
