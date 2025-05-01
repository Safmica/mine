@props(['type', 'course', 'meeting' => null])
@php
    $endpoints = [
        'courses' => route('courses.store'),
        'meetings' => isset($course->id) ? route('courses.meetings.store', ['course' => $course->id]) : '#',
        'files' => '/files/store',
    ];

    $labels = [
        'courses' => 'Course',
        'meetings' => 'Meeting',
        'files' => 'File',
    ];

    $title = [
        'courses' => 'title',
        'meetings' => 'meeting_name',
        'files' => 'File',
    ];

    $desc = [
        'courses' => 'description',
        'meetings' => 'topic',
        'files' => 'File',
    ];

    $endpoint = $endpoints[$type] ?? '#';
    $label = $labels[$type] ?? 'Item';
@endphp

<button onclick="document.getElementById('modal-{{ $type }}').classList.remove('hidden')" 
    class="fixed bottom-6 right-6 bg-cos-yellow font-bold text-3xl text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
    +

</button>

<div id="modal-{{ $type }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg mx-4">
        <h2 class="text-2xl font-semibold mb-6 text-center">Add New {{ $label }}</h2>

        <form action="{{ $endpoint }}" method="POST">
        @csrf
            @php
                $courseId = isset($course->id) ? $course->id: null;
            @endphp
        @if($courseId)
            <input type="hidden" name="course_id" value="{{ $courseId }}">
        @endif
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">
                    @if ($type == 'courses')
                        Title
                    @elseif ($type == 'meetings')
                        Meeting Name
                    @else
                        Item Title
                    @endif
                </label>
                <input type="text" name="{{ $title[$type] }}" id="{{ $title[$type] }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">
                    @if ($type == 'courses')
                        Description
                    @elseif ($type == 'meetings')
                        Topic
                    @else
                        Item Title
                    @endif
                </label>
                <textarea name="{{ $desc[$type] }}" id="{{ $desc[$type] }}" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" onclick="document.getElementById('modal-{{ $type }}').classList.add('hidden')" class="px-6 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 text-sm font-semibold text-white bg-cos-yellow rounded-md hover:bg-cos-dark-yellow transition">Submit</button>
            </div>
        </form>
    </div>
</div>

