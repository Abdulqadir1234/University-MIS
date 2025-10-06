<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'University System') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen font-sans" x-data="{ isRtl: {{ session('locale') === 'fa' ? 'true' : 'false' }}, showProfileModal: false }" :dir="isRtl ? 'rtl' : 'ltr'">

    <!-- Navigation -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="font-bold text-lg">{{ __('messages.dashboard') }}</a>

            @auth
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <a href="{{ route('universities.index') }}">{{ __('messages.universities') }}</a>
                    <a href="{{ route('faculties.index') }}">{{ __('messages.faculties') }}</a>
                    <a href="{{ route('departments.index') }}">{{ __('messages.departments') }}</a>

                    <!-- Language Toggle Button -->
                    @php $locale = session('locale', app()->getLocale()); @endphp
                    <a href="{{ route('lang.switch', $locale === 'en' ? 'fa' : 'en') }}" 
                       class="flex items-center bg-white text-blue-600 px-3 py-1 rounded-full hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 100 20A10 10 0 0010 0zm0 18.182A8.182 8.182 0 1110 1.818a8.182 8.182 0 010 16.364z"/>
                        </svg>
                        {{ $locale === 'en' ? __('messages.persian') : __('messages.english') }}
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-4 rtl:space-x-reverse">
                    <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
                    <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
                </div>
            @endguest
        </div>
    </nav>

    <!-- Optional Page Header -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                {{ $header }}
                <!-- RTL Toggle in Header -->
                <button @click="isRtl = !isRtl" class="bg-gray-200 text-gray-800 px-3 py-1 rounded hover:bg-gray-300 transition">
                    <span x-text="isRtl ? '{{ __('messages.english') }}' : '{{ __('messages.persian') }}'"></span>
                </button>
            </div>
        </header>
    @endisset

    <!-- Main Content -->
    <main class="container mx-auto mt-6">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Profile Modal -->
    @auth
    <div x-show="showProfileModal"
         x-transition
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         x-cloak>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-96 relative">
            <button @click="showProfileModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>

            <div class="flex flex-col items-center mb-4">
                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default.png') }}"
                     class="w-32 h-32 rounded-full object-cover mb-4">
                <h2 class="text-xl font-bold">{{ Auth::user()->name }} {{ Auth::user()->lastname ?? '' }}</h2>
                <p class="text-gray-500">{{ Auth::user()->getRoleNames()->first() ?? 'No Role' }}</p>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-gray-700 dark:text-gray-200">{{ __('messages.name') }}</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 rounded border">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200">{{ __('messages.lastname') }}</label>
                    <input type="text" name="lastname" value="{{ Auth::user()->lastname ?? '' }}" class="w-full px-3 py-2 rounded border">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200">{{ __('messages.profile_photo') }}</label>
                    <input type="file" name="profile_photo" class="w-full px-3 py-2 rounded border">
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">{{ __('messages.update') }}</button>
                    <button type="button" @click="showProfileModal = false" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">{{ __('messages.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
    @endauth

</body>
</html>
