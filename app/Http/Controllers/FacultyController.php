<?php
namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    // Show faculties with pagination, newest first
    public function index() {
        $faculties = Faculty::with('university')
            ->orderBy('id', 'desc')   // newest first
            ->paginate(10);           // 10 per page
        return view('faculties.index', compact('faculties'));
    }

    public function create() {
        $universities = University::all();
        return view('faculties.create', compact('universities'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required',
            'university_id'=>'required|exists:universities,id'
        ]);
        Faculty::create($request->all());
        return redirect()->route('faculties.index');
    }

    public function edit(Faculty $faculty) {
        $universities = University::all();
        return view('faculties.edit', compact('faculty','universities'));
    }

    public function update(Request $request, Faculty $faculty) {
        $request->validate([
            'name'=>'required',
            'university_id'=>'required|exists:universities,id'
        ]);
        $faculty->update($request->all());
        return redirect()->route('faculties.index');
    }

    public function destroy(Faculty $faculty) { 
        $faculty->delete(); 
        return redirect()->route('faculties.index'); 
    }
}
