<nav class="bg-transparent p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-black text-2xl font-bold">
            <a href="/" class="flex flex-row items-center space-x-2">
                <img src="{{ asset('assets/mine_icon.webp') }}" alt="Logo" class="w-10 h-10">
                <p>MINE</p>
            </a>
        </div>        
        <div class="space-x-4">
            @auth
                <span class="text-black px-4 py-2 font-semibold rounded-xl bg-gray-100">{{ Auth::user()->name }}</span>
            @else
                <a href="/login" class="text-black px-4 py-2 font-semibold rounded-xl hover:bg-gray-100 transition">Login</a>
                <a href="/signup" class="text-white px-4 py-2 rounded-xl font-semibold bg-cos-yellow">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>
