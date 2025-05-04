@props(['type', 'course' => null, 'meeting' => null, 'file' => null, 'id'])

@php
    $endpoints = [
        'course' => route('courses.update', $course->id),
        'meeting' => isset($course->id) && isset($meeting->id) ? route('courses.meetings.update', [$course->id, $meeting->id]) : '#',
        'file' => isset($course->id) && isset($meeting->id) && isset($file->id) ? route('courses.meetings.files.update', [$course->id, $meeting->id, $file->id]) : '#',
    ];

    $labels = [
        'course' => 'Course',
        'meeting' => 'Meeting',
        'file' => 'File',
    ];

    $titleField = [
        'course' => 'title',
        'meeting' => 'meeting_name',
        'file' => 'filename',
    ];

    $descField = [
        'course' => 'description',
        'meeting' => 'topic',
        'file' => null,
    ];

    $idComponent = [
        'course' => 'modal-edit-course-' . $course->id,
    ];

    $endpoint = $endpoints[$type] ?? '#';
    $label = $labels[$type] ?? 'Item';
@endphp

<div class="bg-white p-6 rounded-lg w-full max-w-lg mx-4">
    <h2 class="text-2xl font-semibold mb-6 text-center">Edit {{ $label }}</h2>

    <form action="{{ $endpoint }}" method="POST" @if($type === 'file') enctype="multipart/form-data" @endif>
        @csrf
        @method('PATCH')

        @php
            $titleValue = old($titleField[$type], $item->{$titleField[$type]} ?? '');
            $descValue = $descField[$type] ? old($descField[$type], $item->{$descField[$type]} ?? '') : null;
        @endphp

        <div class="mb-4">
            <label for="edit-{{ $titleField[$type] }}" class="block text-sm font-medium text-gray-700">
                {{ $label === 'Meeting' ? 'Meeting Name' : ($label === 'File' ? 'Filename' : 'Title') }}
            </label>
            <input type="text" name="{{ $titleField[$type] }}" id="edit-{{ $titleField[$type] }}"
                    value="{{ $titleValue }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        @if($descField[$type])
            <div class="mb-4">
                <label for="edit-{{ $descField[$type] }}" class="block text-sm font-medium text-gray-700">
                    {{ $label === 'Meeting' ? 'Topic' : 'Description' }}
                </label>
                <textarea name="{{ $descField[$type] }}" id="edit-{{ $descField[$type] }}" rows="4"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>{{ $descValue }}</textarea>
            </div>
        @endif

        @if($type === 'files')
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Replace File (Optional)</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        @endif

        <div class="flex justify-end space-x-4 mt-6">
            <button type="button" onclick="document.getElementById('modal-edit-{{ $id }}').classList.add('hidden')"
                    class="px-6 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition">
                Cancel
            </button>
            <button type="submit" class="px-6 py-2 text-sm font-semibold text-white bg-cos-yellow rounded-md hover:bg-cos-dark-yellow transition">
                Update
            </button>
        </div>
    </form>
</div>
