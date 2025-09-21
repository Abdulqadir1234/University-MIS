<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;

Route::get('/', function () {
    return redirect()->route('universities.index');
});

Route::resource('universities', UniversityController::class);
Route::resource('faculties', FacultyController::class);
Route::resource('departments', DepartmentController::class);

Route::get('/dashboard', function () {
    $universitiesCount = University::count();
    $facultiesCount = Faculty::count();
    $departmentsCount = Department::count();

    $universities = University::all();
    $faculties = Faculty::all();

    // Build one combined dataset for search
    $allItems = collect();

    foreach ($universities as $u) {
        $allItems->push([
            'id' => $u->id,
            'name' => $u->name,
            'type' => 'University',
            'university_id' => $u->id,
            'faculty_id' => null,
            'university' => $u->name,
            'faculty' => null,
        ]);
    }

    foreach ($faculties as $f) {
        $allItems->push([
            'id' => $f->id,
            'name' => $f->name,
            'type' => 'Faculty',
            'university_id' => $f->university_id,
            'faculty_id' => $f->id,
            'university' => $f->university->name ?? null,
            'faculty' => $f->name,
        ]);
    }

    foreach (Department::all() as $d) {
        $allItems->push([
            'id' => $d->id,
            'name' => $d->name,
            'type' => 'Department',
            'university_id' => $d->university_id,
            'faculty_id' => $d->faculty_id,
            'university' => $d->university->name ?? null,
            'faculty' => $d->faculty->name ?? null,
        ]);
    }

    return view('dashboard', compact(
        'universitiesCount',
        'facultiesCount',
        'departmentsCount',
        'universities',
        'faculties',
        'allItems'
    ));
})->name('dashboard');
