<?php

use App\Http\Controllers\Message\MessageController;
use Illuminate\Support\Facades\Route;

Route::controller(MessageController::class)
    ->prefix('messages')
    ->as('messages.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
        Route::post('/{message}/likes', 'like')->name('like');
        Route::post('/{message}/complaints', 'storeComplaint')->name('complaints-store');
    });
