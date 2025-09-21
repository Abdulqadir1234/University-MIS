<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','University MIS')</title>

    {{-- Tailwind CSS --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js locally --}}
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    
</head>

<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        <div class="p-6 text-xl font-bold border-b border-gray-700">
            University MIS
        </div>
        <nav class="mt-6">
            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('universities.index') }}" class="block px-6 py-3 hover:bg-gray-700">Universities</a>
            <a href="{{ route('faculties.index') }}" class="block px-6 py-3 hover:bg-gray-700">Faculties</a>
            <a href="{{ route('departments.index') }}" class="block px-6 py-3 hover:bg-gray-700">Departments</a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

</body>
</html>
