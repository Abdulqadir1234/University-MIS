@extends('layouts.app')
@section('title','Add University')
@section('content')

<h1 class="text-2xl font-bold text-blue-700 mb-4">Add University</h1>

<form action="{{ route('universities.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection
