<?php

use Illuminate\Support\Facades\Route;
use Modules\Import\Http\Controllers\ImportController;

Route::group([
    'middleware' => 'auth',
    'prefix' => 'imports',
], function ($router) {
    Route::post('reguler', [ImportController::class, 'reguler']);
    Route::post('', [ImportController::class, 'login']);
});
