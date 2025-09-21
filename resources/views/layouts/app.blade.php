<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','University System')</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-100 via-pink-100 to-yellow-100 font-sans">
<div class="container mx-auto p-4">

    <nav class="mb-6 flex gap-4 bg-white p-4 rounded shadow">
        <a href="{{ route('dashboard') }}" class="text-purple-700 font-semibold">Dashboard</a>
        <a href="{{ route('universities.index') }}" class="text-pink-700 font-semibold">Universities</a>
        <a href="{{ route('departments.index') }}" class="text-green-700 font-semibold">Departments</a>
        <a href="{{ route('faculties.index') }}" class="text-blue-700 font-semibold">Faculties</a>
    </nav>

    @if(session('success'))
        <div class="bg-green-300 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
