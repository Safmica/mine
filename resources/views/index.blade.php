@extends('layouts.index')

@section('title', 'Index')

@section('content')
<div class="p-4 text-2xl font-bold bg-white" title="{{ Auth::user()->name }}">
    <h1>{{ Auth::user()->name }} > Courses</h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 rounded-lg bg-cos-yellow p-4">
    @if($courses->isEmpty())
    <div class="flex justify-center items-center h-96 w-full col-span-full pt-10">
        <img src="{{ asset('assets/404_course.png') }}" alt="Logo" class="opacity-20 w-[400px]">
    </div>
    @else
        @foreach ($courses as $course)
        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-row items-center h-12">
            <a href="{{ route('meetings.indexByCourse', $course->id) }}" class="w-full group cursor-pointer relative">
                <h3 class="text-lg font-semibold text-center mb-2 truncate w-full">{{ $course->title }}</h3>
                <span class="absolute top-full left-1/2 transform -translate-x-1/2 mb-2 w-max px-2 py-1 text-sm text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    {{ $course->description }}
                </span>
            </a>
            <div x-data="{ open: false }" class="relative">
                <button class="text-gray-500 hover:text-black focus:outline-none" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 6h12M6 18h12" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-md">
                    <ul>
                        <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</a></li>
                        <li class="hover:bg-gray-100">
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-500">
                                    Delete
                                </button>
                            </form>
                        </li>       
                    </ul>
                </div>
            </div>            
        </div>
        @endforeach
    @endif
</div>

@endsection

<script>
    function toggleMenu(courseId) {
        const menu = document.getElementById(`menu-${courseId}`);
        menu.classList.toggle('hidden');
    }
</script>
