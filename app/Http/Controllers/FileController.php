<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Meeting;
use App\Models\Course;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Course $course)
    {
        $files = $course->Files;
        $courses = Course::all();
        
        return view('file', compact('files', 'course', 'courses'));
    }

    public function indexByMeeting(Course $course, Course $meeting)
    {
        $Files = $meeting->Files;
        $meetings = Meeting::all();

        return view('file', compact('files', 'course', 'meeting', 'meetings'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('Files.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'File_name' => 'required|string|max:255',
            'topic' => 'nullable|string|max:255',
        ]);

        File::create($request->all());

        return redirect()->route('Files.indexByCourse', ['course' => $request->course_id])
        ->with('success', 'File created successfully');
    }

    public function edit(File $File)
    {
        $courses = Course::all();
        return view('Files.edit', compact('File', 'courses'));
    }

    public function update(Request $request, File $File)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'File_name' => 'required|string|max:255',
            'topic' => 'nullable|string|max:255',
        ]);

        $File->update($request->all());

        return redirect()->route('Files.index')->with('success', 'File updated successfully');
    }

    public function destroy(File $File)
    {
        $File->delete();

        return redirect()->route('Files.index')->with('success', 'File deleted successfully');
    }
}
