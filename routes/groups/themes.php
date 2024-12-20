<?php

use App\Http\Controllers\Theme\ThemeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->resource('themes', ThemeController::class);
