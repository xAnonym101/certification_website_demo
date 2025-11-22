<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant
;
class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Default function to get items from database and show the list of participants
    public function index()
    {
        $participants = Participant::latest('created_at')->get();
        return view('participants.participantList', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Route to create view for courses
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Data that was created from create view will be stored to database using this function
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'], 
            'address' => 'required|string',
        ], [
            'phone_number.regex' => 'Phone number can only contain numbers, +, -, and spaces.',
        ]);

        Participant::create($validated);
        return redirect()->route('participants.index');
    }

    /**
     * Display the specified resource.
     */
    // This function is specifically to show details of a chosen item
    public function show(string $id)
    {
        $participant = Participant::with('courses')->findOrFail($id);
        return view('participants.showDetail', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Function to get a chosen item and reroute to edit view
    public function edit(string $id)
    {
        $participant = Participant::findOrFail($id);
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Function to update the chosen item that is used when submitting edit
    public function update(Request $request, string $id)
    {
        $participant = Participant::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $id . ',participant_id',
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'address' => 'required|string',
        ], [
            'phone_number.regex' => 'Phone number can only contain numbers, +, -, and spaces.',
        ]);

        $participant->update($validated);
        return redirect()->route('participants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete function to chosen item
    public function destroy(string $id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();
        return redirect()->route('participants.index');
    }
}
