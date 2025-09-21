@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<h1 class="text-4xl font-bold mb-6 text-center text-purple-700">University System Dashboard</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-bold text-pink-600 mb-2">Universities</h2>
        <p class="text-3xl font-bold">{{ \App\Models\University::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-bold text-green-600 mb-2">Departments</h2>
        <p class="text-3xl font-bold">{{ \App\Models\Department::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
        <h2 class="text-xl font-bold text-blue-600 mb-2">Faculties</h2>
        <p class="text-3xl font-bold">{{ \App\Models\Faculty::count() }}</p>
    </div>
</div>
@endsection
