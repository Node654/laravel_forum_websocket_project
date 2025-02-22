<?php

use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)
    ->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

Route::controller(ComplaintController::class)
    ->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/complaints', 'index')->name('index-complaints');
        Route::patch('/complaints/{complaint}', 'update')->name('index-complaints.update');
    });

Route::controller(UserController::class)
    ->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/users', 'index')->name('index-users');
        Route::post('/users/{user}/roles', 'toggleRole')->name('users-roles');
    });

Route::prefix('admins')->as('admins')->resource('roles', RoleController::class);
