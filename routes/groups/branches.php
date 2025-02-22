<?php

use App\Http\Controllers\Branch\BranchController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->resource('branches', BranchController::class);
Route::get('/sections/{section}/branches', [BranchController::class, 'branchIndex'])->name('section-branches.index');
Route::get('/sections/{section}/branches_extract/{branch}', [BranchController::class, 'branchIndexExtract'])->name('section-branches.index-except');
Route::get('/branches/{branch}/themes/create', [BranchController::class, 'themeCreate'])->name('branches.themes.create');
Route::get('/branches/{branch}/parentBranch/create', [BranchController::class, 'createParentBranch'])->name('branches.parent.create');
Route::post('/branches/parentBranch', [BranchController::class, 'storeParentBranch'])->name('branches.parent.store');
