<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    // Store a newly created enrollment (Attach Participant to Course).
    public function enroll(Request $request): RedirectResponse
    {
        $request->validate([
            'course_id' => 'required|exists:courses,course_id',
            'participant_id' => 'required|exists:participants,participant_id'
        ]);
        $course = Course::findOrFail($request->course_id);
        $course->participants()->syncWithoutDetaching([
            $request->participant_id => ['registration_date' => now()]
        ]);

        return back()->with('success', 'Student enrolled successfully!');
    }

    public function discharge(string $course_id, string $participant_id): RedirectResponse
    {
        $course = Course::findOrFail($course_id);    
        $course->participants()->detach($participant_id);

        return back()->with('success', 'Student removed from class.');
    }
}