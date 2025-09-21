<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;

// Dashboard (everyone can access)
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Universities CRUD (no role protection)
Route::resource('universities', UniversityController::class);

// Departments CRUD (no role protection)
Route::resource('departments', DepartmentController::class);

// Faculties CRUD (no role protection)
Route::resource('faculties', FacultyController::class);
