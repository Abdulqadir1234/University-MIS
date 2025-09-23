<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University System</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Alpine.js -->
    {{-- <script src="{{ asset('js/alpine.js') }}" defer></script> --}}
     <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <nav class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('dashboard') }}" class="font-bold">Dashboard</a>
            <div class="space-x-4">
                <a href="{{ route('universities.index') }}">Universities</a>
                <a href="{{ route('faculties.index') }}">Faculties</a>
                <a href="{{ route('departments.index') }}">Departments</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
