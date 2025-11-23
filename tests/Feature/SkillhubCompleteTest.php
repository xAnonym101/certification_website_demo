<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Participant;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillHubCompleteTest extends TestCase
{
    use RefreshDatabase;

    // --------------------------------------------------------------------------
    // PARTICIPANT MANAGEMENT
    // -------------------------------------------------------------------------- 

    // Test that a participant can be created with valid data and redirects correctly
    public function test_create_participant()
    {
        $data = [
            'full_name' => 'Test Student',
            'email' => 'test@student.com',
            'phone_number' => '081234567890',
            'address' => 'Test Address 123'
        ];

        $this->post('/participants', $data)
             ->assertRedirect('/participants');
             
        $this->assertDatabaseHas('participants', ['email' => 'test@student.com']);
    }

    // Test that the participant index page loads and displays created data
    public function test_read_participant_list()
    {
        Participant::factory()->create(['full_name' => 'List Student']);

        $this->get('/participants')
             ->assertStatus(200)
             ->assertSee('List Student');
    }

    // Test that a specific participant's detail page loads correctly (using edit view)
    public function test_read_participant_detail()
    {
        $participant = Participant::factory()->create(['full_name' => 'Detail Student']);

        $this->get("/participants/{$participant->participant_id}/edit")
             ->assertStatus(200)
             ->assertSee('Detail Student');
    }

    // Test that participant data can be updated and changes persist in the database
    public function test_update_participant()
    {
        $participant = Participant::factory()->create(['full_name' => 'Old Name']);

        $this->put("/participants/{$participant->participant_id}", [
            'full_name' => 'New Name',
            'email' => $participant->email,
            'phone_number' => $participant->phone_number,
            'address' => $participant->address,
        ])->assertRedirect(route('participants.edit', $participant->participant_id));

        $this->assertDatabaseHas('participants', ['full_name' => 'New Name']);
    }

    // Test that a participant can be deleted and is removed from the database
    public function test_delete_participant()
    {
        $participant = Participant::factory()->create();

        $this->delete("/participants/{$participant->participant_id}")
             ->assertRedirect('/participants');

        $this->assertDatabaseMissing('participants', ['participant_id' => $participant->participant_id]);
    }

    // -------------------------------------------------------------------------- 
    // COURSE MANAGEMENT
    // -------------------------------------------------------------------------- 

    // Test that a course can be created with valid data
    public function test_create_course()
    {
        $data = [
            'course_name' => 'Laravel 101',
            'course_description' => 'Basic Laravel',
            'instructor_name' => 'Taylor Otwell',
            'start_date' => '2025-01-01',
            'end_date' => '2025-02-01',
        ];

        $this->post('/courses', $data)
             ->assertRedirect('/courses');

        $this->assertDatabaseHas('courses', ['course_name' => 'Laravel 101']);
    }

    // Test that the course index page loads and displays created data
    public function test_read_course_list()
    {
        Course::factory()->create(['course_name' => 'List Course']);

        $this->get('/courses')
             ->assertStatus(200)
             ->assertSee('List Course');
    }

    // Test that a specific course's detail page loads correctly (using edit view)
    public function test_read_course_detail()
    {
        $course = Course::factory()->create(['course_name' => 'Detail Course']);

        $this->get("/courses/{$course->course_id}/edit")
             ->assertStatus(200)
             ->assertSee('Detail Course');
    }

    // Test that course data can be updated and changes persist in the database
    public function test_update_course()
    {
        $course = Course::factory()->create(['course_name' => 'Old Course']);

        $this->put("/courses/{$course->course_id}", [
            'course_name' => 'New Course',
            'course_description' => $course->course_description,
            'instructor_name' => $course->instructor_name,
            'start_date' => '2025-01-01',
            'end_date' => '2025-02-01',
        ])->assertRedirect(route('courses.edit', $course->course_id));

        $this->assertDatabaseHas('courses', ['course_name' => 'New Course']);
    }

    // Test that a course can be deleted and is removed from the database
    public function test_delete_course()
    {
        $course = Course::factory()->create();

        $this->delete("/courses/{$course->course_id}")
             ->assertRedirect('/courses');

        $this->assertDatabaseMissing('courses', ['course_id' => $course->course_id]);
    }

    // -------------------------------------------------------------------------- 
    // REGISTRATION (ENROLLMENT CONTROLLER LOGIC)
    // -------------------------------------------------------------------------- 

    // Test that the enrollment controller action correctly links a participant to a course
    public function test_enroll_student()
    {
        $participant = Participant::factory()->create();
        $course = Course::factory()->create();

        // Uses the new 'enrollments.store' route
        $this->post(route('enrollments.store'), [
            'course_id' => $course->course_id,
            'participant_id' => $participant->participant_id
        ])->assertRedirect();

        $this->assertDatabaseHas('course_participants', [
            'course_id' => $course->course_id,
            'participant_id' => $participant->participant_id
        ]);
    }

    // Test that enrollment data appears on both the Course and Participant detail pages
    public function test_enrollment_visibility()
    {
        $participant = Participant::factory()->create(['full_name' => 'Enrolled Student']);
        $course = Course::factory()->create(['course_name' => 'Enrolled Course']);
        
        $course->participants()->attach($participant->participant_id, ['registration_date' => now()]);

        // Checks the 'edit' route since 'show' is empty in your structure
        $this->get("/courses/{$course->course_id}/edit")
             ->assertSee('Enrolled Student');

        $this->get("/participants/{$participant->participant_id}/edit")
             ->assertSee('Enrolled Course');
    }

    // Test that the discharge controller action correctly removes the link between participant and course
    public function test_drop_student()
    {
        $participant = Participant::factory()->create();
        $course = Course::factory()->create();
        
        $course->participants()->attach($participant->participant_id, ['registration_date' => now()]);

        // Uses the new 'enrollments.destroy' route
        $this->delete(route('enrollments.destroy', [
            'course' => $course->course_id, 
            'participant' => $participant->participant_id
        ]))->assertRedirect();

        $this->assertDatabaseMissing('course_participants', [
            'course_id' => $course->course_id,
            'participant_id' => $participant->participant_id
        ]);
    }
}