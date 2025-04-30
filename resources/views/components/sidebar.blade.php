<div class="sidebar bg-cos-yellow text-black p-4 rounded-r-xl">
    <h3 class="text-lg font-bold">Courses</h3>
    
    @if($courses->isEmpty())
        <p>Tidak ada courses tersedia.</p>
    @else
        <ul class="mt-4">
            @foreach ($courses as $course)
                <li class="mb-2">
                    <a href="#" class="text-black  font-medium hover:text-yellow-500">{{ $course->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
