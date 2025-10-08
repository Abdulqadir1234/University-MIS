<x-app-layout>
@php
    $user = auth()->user();
@endphp

<div x-data="{ isRtl: false, showProfileModal: false }" :dir="isRtl ? 'rtl' : 'ltr'" class="flex min-h-screen transition-all duration-500 bg-gray-100 dark:bg-gray-900">

    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 min-h-screen p-6 transition-all duration-500" :class="{'rtl': isRtl}">
        <!-- Profile card -->
        @auth
        <div @click="showProfileModal = true" class="flex items-center space-x-4 mb-6 hover:bg-gray-700 p-2 rounded transition cursor-pointer">
            <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('default.png') }}" 
                 alt="Profile" class="w-12 h-12 rounded-full object-cover">
            <div>
                <p class="font-bold text-lg">{{ $user->name }} {{ $user->lastname ?? '' }}</p>
                <p class="text-sm text-gray-300">{{ $user->getRoleNames()->first() ?? 'No Role' }}</p>
            </div>
        </div>
        @endauth

        <!-- Sidebar Links -->
        <ul class="space-y-4">
            @role('admin')
            <li><a href="{{ route('universities.index') }}" class="block p-2 rounded hover:bg-gray-700" x-text="isRtl ? 'دانشگاه‌ها' : 'Universities'"></a></li>
            @endrole
            @role('admin|teacher')
            <li><a href="{{ route('faculties.index') }}" class="block p-2 rounded hover:bg-gray-700" x-text="isRtl ? 'دانشکده‌ها' : 'Faculties'"></a></li>
            @endrole
            @role('admin|teacher|student')
            <li><a href="{{ route('departments.index') }}" class="block p-2 rounded hover:bg-gray-700" x-text="isRtl ? 'دپارتمان‌ها' : 'Departments'"></a></li>
            @endrole
            @role('admin|teacher')
            <li><a href="{{ route('courses.index') }}" class="block p-2 rounded hover:bg-gray-700" x-text="isRtl ? 'کورس‌ها' : 'Courses'"></a></li>
            @endrole
        </ul>

        <!-- Language / Direction Toggle -->
        <div class="mt-10">
            <button @click="isRtl = !isRtl" class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded w-full transition">
                <span x-text="isRtl ? 'English' : 'فارسی'"></span>
            </button>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 p-6 transition-all duration-500">

        <!-- Logout button -->
        <div class="flex justify-end mb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition" x-text="isRtl ? 'خروج' : 'Logout'"></button>
            </form>
        </div>

        <!-- Welcome message -->
        @auth
        <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 text-gray-900 dark:text-gray-100"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            <p class="text-lg font-medium" x-text="isRtl ? 'شما وارد شدید به عنوان ' + '{{ $user->getRoleNames()->first() }}' : 'You are logged in as {{ $user->getRoleNames()->first() }}.'"></p>
        </div>
        @endauth

        <!-- Stats cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-indigo-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2" x-text="isRtl ? 'دانشگاه‌ها' : 'Universities'"></h2>
                <p class="text-3xl">{{ \App\Models\University::count() }}</p>
                <a href="{{ route('universities.index') }}" class="text-blue-200 mt-2 inline-block hover:underline" x-text="isRtl ? 'مشاهده همه' : 'View All'"></a>
            </div>
            <div class="bg-green-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2" x-text="isRtl ? 'دانشکده‌ها' : 'Faculties'"></h2>
                <p class="text-3xl">{{ \App\Models\Faculty::count() }}</p>
                <a href="{{ route('faculties.index') }}" class="text-blue-200 mt-2 inline-block hover:underline" x-text="isRtl ? 'مشاهده همه' : 'View All'"></a>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2" x-text="isRtl ? 'دپارتمان‌ها' : 'Departments'"></h2>
                <p class="text-3xl">{{ \App\Models\Department::count() }}</p>
                <a href="{{ route('departments.index') }}" class="text-blue-200 mt-2 inline-block hover:underline" x-text="isRtl ? 'مشاهده همه' : 'View All'"></a>
            </div>
            <div class="bg-purple-500 text-white p-6 rounded shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2" x-text="isRtl ? 'کورس‌ها' : 'Courses'"></h2>
                <p class="text-3xl">{{ \App\Models\Course::count() }}</p>
                <a href="{{ route('courses.index') }}" class="text-blue-200 mt-2 inline-block hover:underline" x-text="isRtl ? 'مشاهده همه' : 'View All'"></a>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow h-96">
                <h2 class="text-xl font-bold mb-4" x-text="isRtl ? 'Courses per Faculty' : 'Courses per Faculty'"></h2>
                <canvas id="coursesChart" class="w-full h-80"></canvas>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow h-96">
                <h2 class="text-xl font-bold mb-4" x-text="isRtl ? 'Departments per University' : 'Departments per University'"></h2>
                <canvas id="departmentsChart" class="w-full h-80"></canvas>
            </div>
        </div>

    </div>

    <!-- Profile Modal -->
    <div x-show="showProfileModal" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-96 relative">
            <button @click="showProfileModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>
            <div class="flex flex-col items-center mb-4">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('default.png') }}" class="w-32 h-32 rounded-full object-cover mb-4">
                <h2 class="text-xl font-bold">{{ $user->name }} {{ $user->lastname ?? '' }}</h2>
                <p class="text-gray-500">{{ $user->getRoleNames()->first() ?? 'No Role' }}</p>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Courses per Faculty
    const coursesData = @json(\App\Models\Faculty::all()->map(fn($f) => [
        'name' => $f->name,
        'count' => \App\Models\Course::where('faculty_id', $f->id)->count()
    ]));
    const ctx1 = document.getElementById('coursesChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: coursesData.map(d => d.name),
            datasets: [{
                label: 'Courses',
                data: coursesData.map(d => d.count),
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Departments per University
    const deptData = @json(\App\Models\University::all()->map(fn($u) => [
        'name' => $u->name,
        'count' => \App\Models\Department::where('university_id', $u->id)->count()
    ]));
    const ctx2 = document.getElementById('departmentsChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: deptData.map(d => d.name),
            datasets: [{
                label: 'Departments',
                data: deptData.map(d => d.count),
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
</x-app-layout>
