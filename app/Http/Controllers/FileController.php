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
        $files = $course->files;
        $meetings = Course::all();
        
        return view('file', compact('files', 'course', 'courses'));
    }

    public function indexByMeeting(Course $course, Meeting $meeting)
    {
        $files = $meeting->files;
        $meetings = Meeting::all();
        $courses = Course::all();
    
        return view('file', compact('files','course', 'courses', 'meeting', 'meetings'));
    }    

    public function create()
    {
        $courses = Course::all();
        return view('Files.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'meeting_id' => 'required|exists:meetings,id',
            'filename' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,zip,rar|max:20480',
        ]);
    
        $filePath = $request->file('file')->store('files', 'public');

        File::create([
            'user_id' => $request->user_id,
            'meeting_id' => $request->meeting_id,
            'filename' => $request->filename,
            'filepath' => $filePath,
        ]);
    
        return redirect()
            ->route('files.indexByMeeting', ['course' => $request->course_id, 'meeting' => $request->meeting_id])
            ->with('success', 'File uploaded successfully!');
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
