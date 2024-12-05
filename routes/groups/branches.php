<?php

use App\Http\Controllers\Branch\BranchController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->resource('branches', BranchController::class);
Route::get('/sections/{section}/branches', [BranchController::class, 'branchIndex'])->name('section-branches.index');
