<?php

use App\Http\Controllers\Section\SectionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->resource('sections', SectionController::class);
