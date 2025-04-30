@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Sign Up to MINE</h2>
        
        <form action="{{ route('signup') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-600 mb-2">Name</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fcbf49]">
            </div>

            <div>
                <label class="block text-gray-600 mb-2">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fcbf49]">
            </div>

            <div>
                <label class="block text-gray-600 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#fcbf49]">
            </div>

            <button type="submit"
                class="w-full bg-[#fcbf49] text-white py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                Sign Up
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Sudah punya akun? 
            <a href="/login" class="text-[#fcbf49] font-semibold hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection
