<?php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\University;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Show departments with pagination, newest first, plus search
    public function index(Request $request) {
        $search = $request->input('search');

        $departments = Department::with(['university','faculty'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhereHas('university', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('faculty', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('id', 'desc')   // newest first
            ->paginate(10)            // 10 per page
            ->appends(['search' => $search]);

        return view('departments.index', compact('departments', 'search'));
    }

    public function create() {
        $universities = University::all();
        $faculties = Faculty::orderBy('id', 'desc')->get();
        return view('departments.create', compact('universities','faculties'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required',
            'university_id'=>'required|exists:universities,id',
            'faculty_id'=>'required|exists:faculties,id'
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index');
    }

    public function edit(Department $department) {
        $universities = University::all();
        $faculties = Faculty::orderBy('id', 'desc')->get();
        return view('departments.edit', compact('department','universities','faculties'));
    }

    public function update(Request $request, Department $department) {
        $request->validate([
            'name'=>'required',
            'university_id'=>'required|exists:universities,id',
            'faculty_id'=>'required|exists:faculties,id'
        ]);
        $department->update($request->all());
        return redirect()->route('departments.index');
    }

    public function destroy(Department $department) { 
        $department->delete(); 
        return redirect()->route('departments.index'); 
    }
}
