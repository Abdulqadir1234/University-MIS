<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','University System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-gray-800 text-white px-6 py-4 flex justify-between">
        <div>
            <a href="{{ route('universities.index') }}" class="mr-4 hover:underline">Universities</a>
            <a href="{{ route('faculties.index') }}" class="mr-4 hover:underline">Faculties</a>
            <a href="{{ route('departments.index') }}" class="hover:underline">Departments</a>
        </div>
        <div>
            <span class="font-bold">University MIS</span>
        </div>
    </nav>

    {{-- Content --}}
    <main class="container mx-auto mt-6 px-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
