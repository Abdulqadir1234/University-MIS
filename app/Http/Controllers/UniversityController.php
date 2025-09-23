<?php
namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    // Show universities with search + pagination
    public function index(Request $request) {
        $search = $request->input('search');

        $universities = University::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('location', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc') // newest first
            ->paginate(10)
            ->appends(['search' => $search]); // keep search in pagination links

        return view('universities.index', compact('universities', 'search'));
    }

    public function create() { 
        return view('universities.create'); 
    }

    public function store(Request $request) {
        $request->validate(['name'=>'required']);
        University::create($request->all());
        return redirect()->route('universities.index');
    }

    public function edit(University $university) { 
        return view('universities.edit', compact('university')); 
    }

    public function update(Request $request, University $university) {
        $request->validate(['name'=>'required']);
        $university->update($request->all());
        return redirect()->route('universities.index');
    }

    public function destroy(University $university) { 
        $university->delete(); 
        return redirect()->route('universities.index'); 
    }
}
