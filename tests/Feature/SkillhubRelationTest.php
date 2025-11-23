<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillHubRelationTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------- 
    // RELATIONSHIP & DATA INTEGRITY
    // -------------------------------------------------------------------------- 

    // To meet the requirement: "Satu peserta dapat mengikuti lebih dari satu kelas"
    public function test_participant_can_enroll_in_multiple_classes()
    {
        $participant = Participant::factory()->create();
        $course1 = Course::factory()->create();
        $course2 = Course::factory()->create();

        $participant->courses()->attach([$course1->getKey(), $course2->getKey()]);

        $this->assertCount(2, $participant->courses);
        $this->assertTrue($participant->courses->contains($course1));
        $this->assertTrue($participant->courses->contains($course2));
    }

    // To meet the requirement: "Satu kelas dapat diikuti oleh banyak peserta"
    public function test_course_can_have_multiple_participants()
    {
        $course = Course::factory()->create();
        $student1 = Participant::factory()->create();
        $student2 = Participant::factory()->create();

        $course->participants()->attach([$student1->getKey(), $student2->getKey()]);

        $this->assertCount(2, $course->participants);
    }

    // To meet the requirement: "Menghapus peserta secara konsisten" (Orphan Data Check)
    // If student is deleted, their enrollment record should disappear, but the course should remain.
    public function test_deleting_participant_removes_enrollment_but_keeps_course()
    {
        $participant = Participant::factory()->create();
        $course = Course::factory()->create();
        
        $participant->courses()->attach($course->getKey());
        
        $this->assertDatabaseHas('course_participants', [
            'participant_id' => $participant->getKey(),
            'course_id' => $course->getKey()
        ]);

        $participant->delete();

        $this->assertDatabaseMissing('participants', [
            $participant->getKeyName() => $participant->getKey()
        ]);
        
        $this->assertDatabaseMissing('course_participants', [
            'participant_id' => $participant->getKey(),
            'course_id' => $course->getKey()
        ]);
        
        $this->assertDatabaseHas('courses', [
            $course->getKeyName() => $course->getKey()
        ]);
    }
}