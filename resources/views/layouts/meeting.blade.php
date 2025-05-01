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

    <div class="flex">
        <div class="w-64 h-screen bg-cos-yellow text-white rounded-lg lg:block hidden">
            @include('components.sidebar', ['courses' => $courses])
        </div>        

        <button onclick="toggleSidebar()" 
            class="lg:hidden fixed bottom-4 left-4 z-50 bg-cos-yellow text-black p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div id="sidebar" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40">
            <div class="w-64 h-full bg-cos-yellow text-white rounded-r-lg p-4">
                @include('components.sidebar', ['courses' => $courses])
            </div>
        </div>

        <div class="w-full h-screen bg-white text-black rounded-lg">
            <p>ID: {{ $course->id }}</p>
            @yield('content')
        </div>
    </div>

    @if(isset($course))
    <x-dynamic-button type="meetings" :course="$course" />
@endif


    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)" 
            class="fixed top-5 left-1/2 -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition"
        >
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)" 
        class="fixed top-5 left-1/2 -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition"
    >
        {{ session('error') }}
    </div>
@endif

</body>
<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    }
</script>
</html>
