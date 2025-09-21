@extends('layouts.app')
@section('title','Add Faculty')
@section('content')

<h1 class="text-2xl font-bold text-blue-700 mb-4">Add Faculty</h1>

<form action="{{ route('faculties.store') }}" method="POST" class="bg-white p-6 rounded shadow" x-data="facultyForm()">
    @csrf

    {{-- Faculty Name --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Faculty Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
        @error('name')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- University Search --}}
    <div class="mb-4" @click.away="open = false">
        <label class="block mb-1 font-semibold">University</label>
        
        {{-- Search input --}}
        <input type="text" x-model="search" @focus="open = true" placeholder="Search University..."
               class="w-full border px-3 py-2 rounded">

        {{-- Hidden input to submit university_id --}}
        <input type="hidden" name="university_id" x-model="selectedId">

        @error('university_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror

        {{-- Dropdown results --}}
        <div x-show="open && filtered.length > 0"
             class="border rounded mt-1 max-h-48 overflow-auto bg-white shadow z-10 absolute w-full"
             x-cloak>
            <template x-for="uni in filtered" :key="uni.id">
                <div @click="selectedId = uni.id; search = uni.name; open = false"
                     class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                     x-text="uni.name">
                </div>
            </template>
        </div>

        {{-- Empty state --}}
        <div x-show="open && filtered.length === 0"
             class="border rounded mt-1 p-2 bg-white text-gray-500"
             x-cloak>
            No universities found.
        </div>
    </div>

    {{-- Submit --}}
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4">
        Create Faculty
    </button>
</form>

{{-- AlpineJS --}}
<script src="//unpkg.com/alpinejs" defer></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('facultyForm', () => ({
        search: '',
        selectedId: '',
        open: false,
        universities: @json($universities->map(fn($u) => ['id'=>$u->id,'name'=>$u->name])),
        get filtered() {
            return this.universities.filter(u =>
                u.name.toLowerCase().includes(this.search.toLowerCase())
            )
        }
    }))
})
</script>

@endsection
