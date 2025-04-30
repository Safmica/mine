<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <x-navbar />
    <div class="flex flex-row fixed">
        <div class="w-64 h-screen bg-cos-yellow text-white rounded-lg">
            @include('components.sidebar', ['courses' => $courses])
        </div>
        <div class="w-screen h-screen bg-white text-white rounded-lg">
            @yield('content')
        </div>
    </div>
    <x-dynamic-button type="courses" />
    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)" 
            class="fixed top-5 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition"
        >
            {{ session('success') }}
        </div>
    @endif
</body>
<script src="//unpkg.com/alpinejs" defer></script>
</html>
