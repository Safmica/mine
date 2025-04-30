@extends('layouts.index')

@section('title', 'Index')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10 flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-10">
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('assets/img_1.webp') }}" alt="Logo" class="max-w-xs w-full h-auto rounded-lg shadow-md">
        </div>
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h1 class="text-3xl font-bold mb-4">Selamat Datang di MINE</h1>
            <p class="text-gray-600 mb-4">
                Platform manajemen course perkuliahan, upload file, dan catatan pertemuan dengan mudah.
            </p>
            <a href="/signup" class="inline-block bg-cos-yellow text-white px-6 py-3 rounded-xl font-semibold hover:bg-yellow-500 transition">
                Daftar Sekarang
            </a>
        </div>
        
    </div>
@endsection
