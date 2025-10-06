<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['faculty','department','teachers'])->latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $faculties = Faculty::all();
        $departments = Department::all();
        $teachers = User::role('teacher')->get();

        return view('courses.create', compact('faculties','departments','teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:courses,code',
            'name' => 'required|string',
            'faculty_id' => 'nullable|exists:faculties,id',
            'department_id' => 'nullable|exists:departments,id',
            'credit_hours' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $course = Course::create($request->only('code','name','faculty_id','department_id','credit_hours','description'));

        if($request->teachers){
            $course->teachers()->sync($request->teachers);
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $faculties = Faculty::all();
        $departments = Department::all();
        $teachers = User::role('teacher')->get();

        return view('courses.edit', compact('course','faculties','departments','teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|string|unique:courses,code,'.$course->id,
            'name' => 'required|string',
            'faculty_id' => 'nullable|exists:faculties,id',
            'department_id' => 'nullable|exists:departments,id',
            'credit_hours' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $course->update($request->only('code','name','faculty_id','department_id','credit_hours','description'));

        $course->teachers()->sync($request->teachers ?? []);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
