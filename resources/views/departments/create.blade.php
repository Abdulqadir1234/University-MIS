@extends('layouts.app')
@section('title','Add Department')
@section('content')

<h1 class="text-2xl font-bold mb-4">Add Department</h1>

<form action="{{ route('departments.store') }}" method="POST" 
      class="bg-white p-6 rounded shadow" 
      x-data="departmentForm()">
    @csrf

    {{-- Department Name --}}
    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" 
               class="w-full border px-3 py-2 rounded" required>
        @error('name')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- University Search --}}
    <div class="mb-4 relative" @click.away="uni.open = false">
        <label class="block font-semibold">University</label>
        <input type="text" x-model="uni.search" @focus="uni.open = true" 
               placeholder="Search University..." 
               class="w-full border px-3 py-2 rounded">
        <input type="hidden" name="university_id" x-model="uni.selectedId">
        @error('university_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror

        <div x-show="uni.open && uni.filtered.length > 0"
             class="border rounded mt-1 max-h-48 overflow-auto bg-white shadow absolute w-full z-10"
             x-cloak>
            <template x-for="u in uni.filtered" :key="u.id">
                <div @click="selectUniversity(u)"
                     class="px-3 py-2 hover:bg-blue-100 cursor-pointer" 
                     x-text="u.name"></div>
            </template>
        </div>

        <div x-show="uni.open && uni.filtered.length === 0" 
             class="border rounded mt-1 p-2 bg-white text-gray-500" x-cloak>
            No universities found.
        </div>
    </div>

    {{-- Faculty Search --}}
    <div class="mb-4 relative" @click.away="fac.open = false">
        <label class="block font-semibold">Faculty</label>
        <input type="text" x-model="fac.search" @focus="fac.open = true" 
               placeholder="Search Faculty..." 
               class="w-full border px-3 py-2 rounded" 
               :disabled="!uni.selectedId">
        <input type="hidden" name="faculty_id" x-model="fac.selectedId">
        @error('faculty_id')<p class="text-red-500 mt-1">{{ $message }}</p>@enderror

        <div x-show="fac.open && fac.filtered.length > 0"
             class="border rounded mt-1 max-h-48 overflow-auto bg-white shadow absolute w-full z-10"
             x-cloak>
            <template x-for="f in fac.filtered" :key="f.id">
                <div @click="selectFaculty(f)"
                     class="px-3 py-2 hover:bg-green-100 cursor-pointer" 
                     x-text="f.name"></div>
            </template>
        </div>

        <div x-show="fac.open && fac.filtered.length === 0" 
             class="border rounded mt-1 p-2 bg-white text-gray-500" x-cloak>
            No faculties found.
        </div>
    </div>

    <button type="submit" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4">
        Save
    </button>
</form>

<script src="{{ asset('js/alpine.min.js') }}" defer></script>
<script>
function departmentForm() {
    return {
        uni: {
            search: '',
            selectedId: '',
            open: false,
            list: @json($universities->map(fn($u)=>['id'=>$u->id,'name'=>$u->name])),
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
            list: @json($faculties->map(fn($f)=>['id'=>$f->id,'name'=>$f->name,'university_id'=>$f->university_id])),
            get filtered() {
                if(!thisForm.uni.selectedId) return [];
                return this.list
                    .filter(f => f.university_id == thisForm.uni.selectedId)
                    .filter(f => f.name.toLowerCase().includes(this.search.toLowerCase()));
            },
            reset() {
                this.search = '';
                this.selectedId = '';
                this.open = false;
            }
        },
        selectUniversity(u) {
            this.uni.selectedId = u.id;
            this.uni.search = u.name;
            this.uni.open = false;
            this.fac.reset();
        },
        selectFaculty(f) {
            this.fac.selectedId = f.id;
            this.fac.search = f.name;
            this.fac.open = false;
        },
    };
}

// Hack to reference form inside getters
let thisForm = null;
document.addEventListener('alpine:init', () => {
    Alpine.data('departmentForm', () => {
        thisForm = departmentForm();
        return thisForm;
    });
});
</script>

@endsection
