@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

{{-- Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-700">Universities</h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $universitiesCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-700">Faculties</h2>
        <p class="text-3xl font-bold text-green-600 mt-2">{{ $facultiesCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-700">Departments</h2>
        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $departmentsCount }}</p>
    </div>
</div>

{{-- Search & Filter --}}
<div x-data="dashboardSearch()" class="bg-white shadow rounded-lg p-6 mb-8">
    <h2 class="text-xl font-semibold mb-4">Search & Filter</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- Search --}}
        <input type="text" x-model="search" placeholder="Search by name..."
               class="border px-3 py-2 rounded w-full">

        {{-- University Filter --}}
        <select x-model="selectedUniversity" class="border px-3 py-2 rounded w-full">
            <option value="">All Universities</option>
            @foreach($universities as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>

        {{-- Faculty Filter --}}
        <select x-model="selectedFaculty" class="border px-3 py-2 rounded w-full">
            <option value="">All Faculties</option>
            @foreach($faculties as $f)
                <option value="{{ $f->id }}">{{ $f->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Results --}}
    <div class="mt-6">
        <template x-if="filtered.length > 0">
            <table class="w-full border-collapse bg-white shadow rounded">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">University</th>
                        <th class="px-4 py-2 border">Faculty</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="item in filtered" :key="item.id">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border" x-text="item.name"></td>
                            <td class="px-4 py-2 border" x-text="item.type"></td>
                            <td class="px-4 py-2 border" x-text="item.university ?? '-'"></td>
                            <td class="px-4 py-2 border" x-text="item.faculty ?? '-'"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </template>

        <template x-if="filtered.length === 0">
            <p class="text-gray-500">No results found.</p>
        </template>
    </div>
</div>

{{-- Quick Links --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('universities.index') }}" class="bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600 text-center">
        Manage Universities
    </a>
    <a href="{{ route('faculties.index') }}" class="bg-green-500 text-white p-6 rounded-lg shadow hover:bg-green-600 text-center">
        Manage Faculties
    </a>
    <a href="{{ route('departments.index') }}" class="bg-purple-500 text-white p-6 rounded-lg shadow hover:bg-purple-600 text-center">
        Manage Departments
    </a>
</div>

{{-- AlpineJS --}}
<script src="//unpkg.com/alpinejs" defer></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboardSearch', () => ({
        search: '',
        selectedUniversity: '',
        selectedFaculty: '',
        list: @json($allItems), // we’ll pass data from controller
        get filtered() {
            return this.list.filter(item =>
                item.name.toLowerCase().includes(this.search.toLowerCase()) &&
                (this.selectedUniversity === '' || item.university_id == this.selectedUniversity) &&
                (this.selectedFaculty === '' || item.faculty_id == this.selectedFaculty)
            )
        }
    }))
})
</script>

@endsection
