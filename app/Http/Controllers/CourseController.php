<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())->get(); 
        return view('index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(), 
        ]);

        return redirect()->route('index')->with('success', 'Course berhasil dibuat!');
    }

    public function edit(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to edit this course');
        }

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to update this course');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            return redirect()->route('index')->with('error', 'You do not have permission to delete this course');
        }

        $course->delete();

        return redirect()->route('index')->with('success', 'Course berhasil dihapus!');
    }

    public function show(Course $course)
{
    abort(404);
}

}
