<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/personal', 'personal')->name('personal');
        Route::patch('/personal', 'update')->name('personal-update');
    });
