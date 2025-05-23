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
    public function indexByCourse(Course $course)
    {
        $this->authorize('view', $course);
        $meetings = $course->meetings;
        $courses = Course::where('user_id', Auth::id())->get(); 

        return view('meeting', compact('meetings', 'course', 'courses'));
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

    public function update(Request $request, Course $course, Meeting $meeting)
    {
        $request->validate([
            'meeting_name' => 'required|string|max:255',
            'topic' => 'nullable|string|max:255',
        ]);
    
        $meeting->update($request->all());

        return redirect()->route('meetings.indexByCourse', ['course' => $course->id])
        ->with('success', 'Meeting updated successfully.');
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
