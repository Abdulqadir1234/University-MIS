@extends('layouts.app')
@section('title','Add Department')
@section('content')

<h1 class="text-2xl font-bold text-green-700 mb-4">Add Department</h1>

<form action="{{ route('departments.store') }}" method="POST" class="bg-white p-6 rounded shadow" x-data="departmentForm()">
    @csrf

    {{-- Department Name --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
        @error('name')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- University Search --}}
    <div class="mb-4" @click.away="uni.open = false">
        <label class="block mb-1 font-semibold">University</label>
        <input type="text" x-model="uni.search" @input="uni.open = true" placeholder="Search University..."
               class="w-full border px-3 py-2 rounded">
        <input type="hidden" name="university_id" x-model="uni.selectedId">
        @error('university_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror

        <div x-show="uni.open && uni.filtered.length > 0" class="border rounded mt-1 max-h-48 overflow-auto bg-white shadow" x-cloak>
            <template x-for="u in uni.filtered" :key="u.id">
                <div @click="uni.selectedId = u.id; uni.search = u.name; uni.open = false; fac.selectedId = ''; fac.search = ''"
                     class="px-3 py-2 hover:bg-green-100 cursor-pointer" x-text="u.name"></div>
            </template>
        </div>

        <div x-show="uni.open && uni.filtered.length == 0" class="border rounded mt-1 p-2 bg-white text-gray-500" x-cloak>
            No universities found.
        </div>
    </div>

    {{-- Faculty Search --}}
    <div class="mb-4" @click.away="fac.open = false">
        <label class="block mb-1 font-semibold">Faculty</label>
        <input type="text" x-model="fac.search" @input="fac.open = true" placeholder="Search Faculty..."
               class="w-full border px-3 py-2 rounded" :disabled="!uni.selectedId">
        <input type="hidden" name="faculty_id" x-model="fac.selectedId">
        @error('faculty_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror

        <div x-show="fac.open && fac.filtered.length > 0" class="border rounded mt-1 max-h-48 overflow-auto bg-white shadow" x-cloak>
            <template x-for="f in fac.filtered" :key="f.id">
                <div @click="fac.selectedId = f.id; fac.search = f.name; fac.open = false"
                     class="px-3 py-2 hover:bg-green-100 cursor-pointer" x-text="f.name"></div>
            </template>
        </div>

        <div x-show="fac.open && fac.filtered.length == 0" class="border rounded mt-1 p-2 bg-white text-gray-500" x-cloak>
            No faculties found.
        </div>
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mt-4">
        Create
    </button>
</form>

{{-- AlpineJS Offline Version --}}
<script src="{{ asset('js/alpine.min.js') }}" defer></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('departmentForm', () => ({
        uni: {
            search: '',
            selectedId: '',
            open: false,
            list: @json($universities->map(fn($u) => ['id'=>$u->id,'name'=>$u->name])),
            get filtered() {
                return this.list.filter(u =>
                    u.name.toLowerCase().includes(this.search.toLowerCase())
                );
            }
        },
        fac: {
            search: '',
            selectedId: '',
            open: false,
            list: @json($faculties->map(fn($f) => ['id'=>$f->id,'name'=>$f->name,'university_id'=>$f->university_id])),
            get filtered() {
                return this.list
                    .filter(f => f.university_id == this.$root.uni.selectedId)
                    .filter(f => f.name.toLowerCase().includes(this.search.toLowerCase()));
            }
        }
    }))
})
</script>

@endsection
