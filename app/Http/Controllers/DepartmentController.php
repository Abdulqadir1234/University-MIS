<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        // Fetch departments with university relationship, 8 per page
        $departments = Department::with('university')->paginate(8);

        return view('departments.index', compact('departments'));
    }

 public function create() {
    $universities = University::all();
    $faculties = Faculty::all(); // fetch all faculties
    return view('departments.create', compact('universities', 'faculties'));
}


    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'university_id' => 'required'
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success','Department created!');
    }

    public function edit(Department $department) {
        $universities = University::all();
        return view('departments.edit', compact('department','universities'));
    }

    public function update(Request $request, Department $department) {
        $request->validate([
            'name' => 'required',
            'university_id' => 'required'
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success','Department updated!');
    }

    public function destroy(Department $department) {
        $department->delete();
        return redirect()->route('departments.index')->with('success','Department deleted!');
    }
}
