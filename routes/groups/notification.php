<?php

use App\Http\Controllers\Notification\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('notifications')
    ->as('notifications.')
    ->controller(NotificationController::class)
    ->group(function () {
        Route::patch('/', 'update')->name('update');
    });
