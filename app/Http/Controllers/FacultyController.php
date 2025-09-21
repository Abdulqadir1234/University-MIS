<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use App\Models\University;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index() {
        // Use pagination: 10 per page
        $faculties = Faculty::with('department.university')->paginate(10);
        return view('faculties.index', compact('faculties'));
    }

public function create() {
    $universities = University::with('departments')->get();
    return view('faculties.create', compact('universities'));
}


   public function store(Request $request) {
    $request->validate([
        'name' => 'required',
        'university_id' => 'required|exists:universities,id',
        'department_id' => 'required|exists:departments,id',
    ]);

    Faculty::create($request->only('name','university_id','department_id'));

    return redirect()->route('faculties.index')->with('success','Faculty created!');
}

    public function edit(Faculty $faculty) {
        $departments = Department::with('university')->get();
        return view('faculties.edit', compact('faculty','departments'));
    }

    public function update(Request $request, Faculty $faculty) {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required'
        ]);
        $faculty->update($request->all());
        return redirect()->route('faculties.index')->with('success','Faculty updated!');
    }

    public function destroy(Faculty $faculty) {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success','Faculty deleted!');
    }
}
