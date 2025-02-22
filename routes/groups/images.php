<?php

use App\Http\Controllers\Image\ImageController;
use Illuminate\Support\Facades\Route;

Route::controller(ImageController::class)
    ->prefix('/images')
    ->as('images.')
    ->group(function () {
        Route::post('', 'store')->name('store');
    });
