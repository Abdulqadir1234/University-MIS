@extends('layouts.app')
@section('title','Edit Department')
@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Department</h1>

<form action="{{ route('departments.update',$department) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf @method('PUT')
    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" value="{{ $department->name }}" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">University</label>
        <select name="university_id" class="w-full border px-3 py-2 rounded" required>
            @foreach($universities as $uni)
                <option value="{{ $uni->id }}" @if($department->university_id==$uni->id) selected @endif>{{ $uni->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Faculty</label>
        <select name="faculty_id" class="w-full border px-3 py-2 rounded" required>
            @foreach($faculties as $fac)
                <option value="{{ $fac->id }}" @if($department->faculty_id==$fac->id) selected @endif>{{ $fac->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
