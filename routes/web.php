<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;

Route::get('/', function() { return view('dashboard'); })->name('dashboard');

Route::resource('universities', UniversityController::class);
Route::resource('faculties', FacultyController::class);
Route::resource('departments', DepartmentController::class);
