<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillHubRelationTest extends TestCase
{
    use RefreshDatabase;

    /** * Requirement from PDF: "Satu peserta dapat mengikuti lebih dari satu kelas" 
     */
    public function test_participant_can_enroll_in_multiple_classes()
    {
        // 1. Create 1 Participant and 2 Courses
        $participant = Participant::factory()->create();
        $course1 = Course::factory()->create();
        $course2 = Course::factory()->create();

        // 2. Attach (Enroll) them
        // FIX: Pass the Model objects directly. 
        // If Course uses 'course_id' as PK, $course1->id would be null. Passing object fixes this.
        $participant->courses()->attach([$course1->getKey(), $course2->getKey()]);

        // 3. Assert Count in Database
        $this->assertCount(2, $participant->courses);
        $this->assertTrue($participant->courses->contains($course1));
        $this->assertTrue($participant->courses->contains($course2));
    }

    /** * Requirement from PDF: "Satu kelas dapat diikuti oleh banyak peserta" 
     */
    public function test_course_can_have_multiple_participants()
    {
        $course = Course::factory()->create();
        $student1 = Participant::factory()->create();
        $student2 = Participant::factory()->create();

        // FIX: Pass models directly or use getKey() to safely get the ID/UUID
        $course->participants()->attach([$student1->getKey(), $student2->getKey()]);

        $this->assertCount(2, $course->participants);
    }

    /** * Requirement from PDF: "Menghapus peserta (dengan aturan konsisten)"
     * Scenario: If we delete a student, their enrollment record should disappear, 
     * but the Course should remain.
     */
    public function test_deleting_participant_removes_enrollment_but_keeps_course()
    {
        $participant = Participant::factory()->create();
        $course = Course::factory()->create();
        
        // Enroll
        $participant->courses()->attach($course->getKey());
        
        // Verify database has the pivot record
        // FIX: Use 'course_participants' (plural) to match your DB
        // FIX: Use getKey() to dynamically get 'participant_id' or 'id'
        $this->assertDatabaseHas('course_participants', [
            'participant_id' => $participant->getKey(),
            'course_id' => $course->getKey()
        ]);

        // ACT: Delete Participant
        $participant->delete();

        // ASSERT:
        // 1. Participant is gone
        $this->assertDatabaseMissing('participants', [
            $participant->getKeyName() => $participant->getKey()
        ]);
        
        // 2. Enrollment (Pivot) is gone (Clean up)
        $this->assertDatabaseMissing('course_participants', [
            'participant_id' => $participant->getKey(),
            'course_id' => $course->getKey()
        ]);
        
        // 3. Course still exists (Important!)
        $this->assertDatabaseHas('courses', [
            $course->getKeyName() => $course->getKey()
        ]);
    }
}