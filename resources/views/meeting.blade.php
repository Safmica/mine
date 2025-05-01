<!-- resources/views/meeting.blade.php -->
@extends('layouts.meeting')

@section('title', 'Meetings for Course: ' . $course->title)

@section('content')
<div class="p-4 text-2xl font-bold">
    <h1>Meetings for Course: {{ $course->title }}</h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($meetings as $meeting)
    <div class="bg-white rounded-lg shadow-lg p-4 flex flex-row items-center h-15 overflow-auto">
        <h3 class="text-lg font-semibold text-center mb-2 truncate w-full">{{ $meeting->meeting_name }}</h3>
    </div>
    @endforeach
</div>
@endsection
