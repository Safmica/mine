<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Meeting;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FileController extends Controller
{
    use AuthorizesRequests;
    public function indexByMeeting(Course $course, Meeting $meeting)
    {
        $this->authorize('view', $course);
        $files = $meeting->files;
        $courses = Course::where('user_id', Auth::id())->get(); 
    
        return view('file', compact('files','course', 'courses', 'meeting'));
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
    

    public function update(Request $request, Course $course, Meeting $meeting, File $File)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
        ]);

        $File->update($request->all());
    
        return redirect()
        ->route('files.indexByMeeting', ['course' => $course->id, $meeting->id])
        ->with('success', 'File updated successfully!');
    }

    public function destroy(Course $course, Meeting $meeting, File $file)
    {
        if ($file->meeting_id !== $meeting->id) {
            return redirect()->route('meetings.indexByCourse', $course->id)->with('error', 'Invalid file');
        }
    
        $file->delete();
    
        return redirect()->route('files.indexByMeeting', [$course->id, $meeting->id])->with('success', 'File deleted successfully');
    }    
}
