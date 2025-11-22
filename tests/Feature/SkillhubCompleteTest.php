<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Participant;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase; 

class SkillHubCompleteTest extends TestCase
{
    use RefreshDatabase;

    // Test Requirement 1: Participant CRUD (Create, Read, Update, Delete)   
    public function test_participant_lifecycle_crud(): void
    {
        // Create
        $data = [
            'full_name' => 'Test New Participant',
            'email' => 'test_lifecycle@mail.com',
            'phone_number' => '081299998888',
            'address' => 'Jl. Test Lifecycle No. 1'
        ];

        $response = $this->post('/participants', $data);
        $response->assertRedirect('/participants');
        $this->assertDatabaseHas('participants', ['email' => 'test_lifecycle@mail.com']);

        $participant = Participant::where('email', 'test_lifecycle@mail.com')->first();

        // Read List
        $response = $this->get('/participants');
        $response->assertStatus(200);
        $response->assertSee('Test New Participant');

        // Read Detail
        $response = $this->get("/participants/{$participant->participant_id}");
        $response->assertStatus(200);
        $response->assertSee('Student Profile'); 

        // Update
        $updateData = [
            'full_name' => 'Test Participant Update', 
            'email' => 'test_lifecycle@mail.com',
            'phone_number' => '081299998888',
            'address' => 'Jl. Test Lifecycle No. 1'
        ];
        
        $response = $this->put("/participants/{$participant->participant_id}", $updateData);
        $response->assertRedirect('/participants');
        $this->assertDatabaseHas('participants', ['full_name' => 'Test Participant Update']);

        // Delete
        $response = $this->delete("/participants/{$participant->participant_id}");
        $response->assertRedirect('/participants');
        $this->assertDatabaseMissing('participants', ['email' => 'test_lifecycle@mail.com']);
    }


    // Test Requirement 2: Course CRUD (Create, Read, Update, Delete)
    public function test_course_lifecycle_crud(): void
    {
        // Create
        $data = [
            'course_name' => 'Unit Test Course',
            'course_description' => 'Learning Laravel testing',
            'instructor_name' => 'Professor Test',
            'start_date' => '2025-01-01',
            'end_date' => '2025-02-01',
        ];

        $response = $this->post('/courses', $data);
        $response->assertRedirect('/courses');
        $this->assertDatabaseHas('courses', ['course_name' => 'Unit Test Course']);

        $course = Course::where('course_name', 'Unit Test Course')->first();

        // Read List
        $response = $this->get('/courses');
        $response->assertStatus(200);
        $response->assertSee('Unit Test Course');

        // Read Detail
        $response = $this->get("/courses/{$course->course_id}");
        $response->assertStatus(200);
        $response->assertSee('Professor Test');

        // Update
        $updateData = array_merge($data, ['course_name' => 'Unit Test Course Updated']);
        
        $response = $this->put("/courses/{$course->course_id}", $updateData);
        $response->assertRedirect('/courses');
        $this->assertDatabaseHas('courses', ['course_name' => 'Unit Test Course Updated']);

        // Delete
        $response = $this->delete("/courses/{$course->course_id}");
        $response->assertRedirect('/courses');
        $this->assertDatabaseMissing('courses', ['course_name' => 'Unit Test Course Updated']);
    }

    // Test Requirement 3: Registration, List Registrants, Delete Registration  
    public function test_registration_lifecycle(): void
    {
        // Setup: Create Fresh Data
        $participant = Participant::create([
            'full_name' => 'Registration Student',
            'email' => 'reg_student@test.com',
            'phone_number' => '000000',
            'address' => 'Test'
        ]);

        $course = Course::create([
            'course_name' => 'Registration Class',
            'course_description' => 'Desc',
            'instructor_name' => 'Teacher',
        ]);

        // Enroll (Create)
        $response = $this->post(route('courses.enroll', $course->course_id), [
            'participant_id' => $participant->participant_id
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('course_participants', [
            'course_id' => $course->course_id,
            'participant_id' => $participant->participant_id
        ]);

        // Check Course Page (Read)
        $response = $this->get("/courses/{$course->course_id}");
        $response->assertSee('Registration Student'); 

        // Check Participant Page (Read)
        $response = $this->get("/participants/{$participant->participant_id}");
        $response->assertSee('Registration Class'); 

        // Drop/Discharge (Delete)
        $response = $this->delete(route('courses.discharge', [
            'course' => $course->course_id, 
            'participant' => $participant->participant_id
        ]));

        $response->assertRedirect();
        $this->assertDatabaseMissing('course_participants', [
            'course_id' => $course->course_id,
            'participant_id' => $participant->participant_id
        ]);
    }
}