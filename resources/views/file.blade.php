@extends('layouts.index')

@section('title', 'Files')

@section('content')
<div class="p-4 flex flex-row bg-white items-center space-x-2">
    <a href="/">
        <h1 class="text-2xl font-bold truncate overflow-hidden whitespace-nowrap max-w-xs" title="{{ Auth::user()->name }}">
            {{ Auth::user()->name }}
        </h1>
    </a>
    <a href="{{ route('meetings.indexByCourse', $course->id) }}">
        <h1 class="text-2xl font-bold truncate overflow-hidden whitespace-nowrap max-w-xs" title="{{ $course->title }}">
            > {{ $course->title }}
        </h1>
    </a>
    <a href="{{ route('meetings.indexByCourse', $course->id) }}">
        <h1 class="text-2xl font-bold truncate overflow-hidden whitespace-nowrap max-w-xs" title="{{ $meeting->meeting_name }}">
            > {{ $meeting->meeting_name }}
        </h1>
    </a>
    <h1 class="text-2xl font-bold flex-shrink-0">
        > Files
    </h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @if($files->isEmpty())
    <div class="flex justify-center items-center h-96 w-full col-span-full pt-10">
        <img src="{{ asset('assets/404_file.png') }}" alt="Logo" class="opacity-20 w-[400px]">
    </div>
    @else
        @foreach ($files as $file)
        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-row items-center h-12">
            <a href="{{ asset('storage/' . $file->filepath) }}" target="_blank" class="w-full group cursor-pointer relative">
                <h3 class="text-lg font-semibold text-center mb-2 truncate w-full">{{ $file->filename }}</h3>
            </a>
            <div id="modal-edit-{{ $file->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <x-form-edit type="file" :course="$course" :meeting="$meeting"  :file="$file" :id="$file->id"/>
            </div>
            <div x-data="{ open: false }" class="relative">
                <button class="text-gray-500 hover:text-black focus:outline-none" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 6h12M6 18h12" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-md">
                    <ul>
                        <li class="hover:bg-gray-100">
                            <button onclick="document.getElementById('modal-edit-{{ $file->id }}').classList.remove('hidden')" 
                                    class="w-full text-left px-4 py-2 text-black">
                                Edit
                            </button>
                        </li>   
                        <li class="hover:bg-gray-100">
                            <form action="{{route('courses.meetings.files.destroy', [$course->id,$meeting->id, $file->id])}}" method="POST" class="w-full">
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
    function toggleMenu(fileId) {
        const menu = document.getElementById(`menu-${fileId}`);
        menu.classList.toggle('hidden');
    }
</script>
