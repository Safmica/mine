<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MeetingController extends Controller
{
    use AuthorizesRequests;
    public function index(Course $course)
    {
        $meetings = $course->meetings;
        $courses = Course::all();
        
        return view('meeting', compact('meetings', 'course', 'courses'));
    }

    public function indexByCourse(Course $course)
    {
        $this->authorize('view', $course);
        $meetings = $course->meetings;
        $courses = Course::where('user_id', Auth::id())->get(); 

        return view('meeting', compact('meetings', 'course', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('meetings.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'meeting_name' => 'required|string|max:255',
            'topic' => 'nullable|string|max:255',
        ]);

        Meeting::create($request->all());

        return redirect()->route('meetings.indexByCourse', ['course' => $request->course_id])
        ->with('success', 'Meeting created successfully');
    }

    public function edit(Meeting $meeting)
    {
        $courses = Course::all();
        return view('meetings.edit', compact('meeting', 'courses'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'meeting_name' => 'required|string|max:255',
            'topic' => 'nullable|string|max:255',
        ]);

        $meeting->update($request->all());

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully');
    }
    public function destroy(Course $course, Meeting $meeting)
    {
        if ($meeting->course_id !== $course->id) {
            return redirect()->route('meetings.indexByCourse', $course->id)->with('error', 'Invalid meeting');
        }
    
        $meeting->delete();
    
        return redirect()->route('meetings.indexByCourse', $course->id)->with('success', 'Meeting deleted successfully');
    }    
}
