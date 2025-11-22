<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $courses = \App\Models\Course::factory(10)->create();

        $participants = \App\Models\Participant::factory(50)->create();

        foreach ($participants as $participant) {
            $participant->courses()->attach(
                $courses->random(rand(1, 3))->pluck('course_id')->toArray(),
                ['registration_date' => now()]
            );
        }
    }
}
