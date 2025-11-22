<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::withCount('participants')->latest('created_at')->get();
        return view('courses.courseList', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'required|string',
            'instructor_name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('participants')->findOrFail($id);
        $existingIds = $course->participants->pluck('participant_id');
        $availableParticipants = \App\Models\Participant::whereNotIn('participant_id', $existingIds)->get();
        return view('courses.showDetail', compact('course', 'availableParticipants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'required|string',
            'instructor_name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $course->update($validated);
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index');
    }

    /**
     * Custom classes
     */
    public function enroll(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);

        $request->validate([
            'participant_id' => 'required|exists:participants,participant_id'
        ]);

        $course->participants()->attach($request->participant_id, [
            'registration_date' => now()
        ]);

        return redirect()->route('courses.show', $course_id)->with('success', 'Student enrolled successfully!');
    }

    public function discharge($course_id, $participant_id)
    {
        $course = Course::findOrFail($course_id);
        $course->participants()->detach($participant_id);
        return redirect()->route('courses.show', $course_id)->with('success', 'Student removed from class.');
    }
}
