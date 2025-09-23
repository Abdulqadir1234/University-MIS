<?php
namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    // Show faculties with pagination, newest first, plus search
    public function index(Request $request) {
        $search = $request->input('search');

        $faculties = Faculty::with('university')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhereHas('university', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('id', 'desc')   // newest first
            ->paginate(10)            // 10 per page
            ->appends(['search' => $search]); // keep search term in pagination links

        return view('faculties.index', compact('faculties', 'search'));
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
