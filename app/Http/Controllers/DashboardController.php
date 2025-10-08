<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'universities' => University::count(),
            'faculties' => Faculty::count(),
            'departments' => Department::count(),
            'courses' => Course::count(),
            'teachers' => User::role('teacher')->count(),
            'students' => User::role('student')->count(),
            'latestCourses' => Course::with(['faculty', 'department', 'teachers'])->latest()->take(5)->get(),
        ];

        return view('dashboard', compact('user', 'data'));
    }
}
