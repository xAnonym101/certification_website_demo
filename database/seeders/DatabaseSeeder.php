<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Participant;

class DatabaseSeeder extends Seeder
{
    // Seeder runs the factory to generate mass amount of data
    public function run(): void
    {
        // Create 10 Courses
        $courses = Course::factory(10)->create();

        // Create 50 Participants
        $participants = Participant::factory(50)->create();

        // Randomly enroll participants
        foreach ($participants as $participant) {
            $participant->courses()->attach(
                $courses->random(rand(1, 3))->pluck('course_id')->toArray(),
                ['registration_date' => now()]
            );
        }
    }
}