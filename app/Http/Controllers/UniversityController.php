<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index() {
        // Fetch universities with 8 per page
        $universities = University::paginate(8);

        return view('universities.index', compact('universities'));
    }

    public function create() {
        return view('universities.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        University::create($request->all());
        return redirect()->route('universities.index')->with('success','University created!');
    }

    public function edit(University $university) {
        return view('universities.edit', compact('university'));
    }

    public function update(Request $request, University $university) {
        $request->validate([
            'name' => 'required'
        ]);

        $university->update($request->all());
        return redirect()->route('universities.index')->with('success','University updated!');
    }

    public function destroy(University $university) {
        $university->delete();
        return redirect()->route('universities.index')->with('success','University deleted!');
    }
}
