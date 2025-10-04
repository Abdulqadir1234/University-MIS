<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('dashboard');
});

// Dashboard route (protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes group
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // profile view
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // profile edit
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // update
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // delete

    // University system routes
    Route::resource('universities', UniversityController::class);
    Route::resource('faculties', FacultyController::class);
    Route::resource('departments', DepartmentController::class);
});

require __DIR__.'/auth.php';
