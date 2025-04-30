@php
    $endpoints = [
        'courses' => '/courses/store',
        'meetings' => '/meetings/store',
        'files' => '/files/store',
    ];

    $labels = [
        'courses' => 'Course',
        'meetings' => 'Meeting',
        'files' => 'File',
    ];

    $endpoint = $endpoints[$type] ?? '#';
    $label = $labels[$type] ?? 'Item';
@endphp

<button onclick="document.getElementById('modal-{{ $type }}').classList.remove('hidden')" 
    class="fixed bottom-6 right-6 bg-cos-yellow font-bold text-3xl text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
    +
    
</button>

<!-- Modal -->
<div id="modal-{{ $type }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded w-1/3">
        <h2 class="text-xl font-bold mb-4">Add New {{ $label }}</h2>

        <form action="{{ $endpoint }}" method="POST">
            @csrf
            <!-- Contoh input -->
            <input type="text" name="name" placeholder="Enter {{ $label }} Name" class="border p-2 w-full mb-4">
            
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modal-{{ $type }}').classList.add('hidden')" 
                    class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</div>
