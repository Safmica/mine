<div class="sidebar bg-cos-yellow text-black p-4 rounded-xl max-h-screen overflow-auto">
    <h2 class="text-2xl font-bold">Courses List</h2>
    
    @if($courses->isEmpty())
        <p>Tidak ada course tersedia.</p>
    @else
        <ul class="mt-4">
            @foreach ($courses as $course)
                <li class="mb-2">
                    <a href="{{ route('meetings.indexByCourse', $course->id) }}"
                        class="block px-3 py-2 rounded-lg text-black font-medium hover:bg-white hover:text-yellow-600 transition duration-200 break-words">
                        {{ $course->title }}
                     </a>                     
                </li>
            @endforeach
        </ul>
    @endif
</div>
