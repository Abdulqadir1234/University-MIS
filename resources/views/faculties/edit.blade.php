@extends('layouts.app')
@section('title','Edit Faculty')
@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Faculty</h1>

<form action="{{ route('faculties.update',$faculty) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf @method('PUT')
    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" value="{{ $faculty->name }}" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">University</label>
        <select name="university_id" class="w-full border px-3 py-2 rounded" required>
            @foreach($universities as $uni)
                <option value="{{ $uni->id }}" @if($faculty->university_id==$uni->id) selected @endif>{{ $uni->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
