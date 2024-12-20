<?php

use App\Http\Controllers\Message\MessageController;
use Illuminate\Support\Facades\Route;

Route::controller(MessageController::class)
    ->prefix('messages')
    ->as('messages.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
});
