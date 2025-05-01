@extends('layouts.index')

@section('title', 'Index')

@section('content')
@section('content')
<div class="p-4 flex flex-row items-center space-x-2">
    <a href="{{ route('meetings.indexByCourse', $course->id) }}">
        <h1 class="text-2xl font-bold truncate overflow-hidden whitespace-nowrap max-w-xs" title="{{ $course->title }}">
            {{ $course->title }}
        </h1>
    </a>
    <h1 class="text-2xl font-bold flex-shrink-0">
        > Meetings
    </h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($meetings as $meeting)
    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-row items-center h-12">
        {{-- {{ route('files.indexByMeeting', $course->id,$meeting->id) }} --}}
        <a href="" class="w-full group cursor-pointer relative">
            <h3 class="text-lg font-semibold text-center mb-2 truncate w-full">{{ $meeting->meeting_name }}</h3>
            <span class="absolute top-full left-1/2 transform -translate-x-1/2 mb-2 w-max px-2 py-1 text-sm text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                {{ $meeting->topic }}
            </span>
        </a>
        <div class="relative">
            <button class="text-gray-500 hover:text-black focus:outline-none" onclick="toggleMenu({{ $meeting->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 6h12M6 18h12" />
                </svg>
            </button>
            <div id="menu-{{ $meeting->id }}" class="hidden absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-md z-50">
                <ul>
                    <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</a></li>
                    <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

<script>
    function toggleMenu(meetingId) {
        const menu = document.getElementById(`menu-${meetingId}`);
        menu.classList.toggle('hidden');
    }
</script>
