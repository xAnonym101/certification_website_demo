<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // The code to migrate weak entity table connecting participants and courses
        Schema::create('course_participants', function (Blueprint $table) {
            $table->id("course_participant_id");

            // Foreign Key (FK) from Primary Key of participants and courses
            $table->foreignId("participant_id")->constrained("participants", "participant_id")->onDelete("cascade");
            $table->foreignId("course_id")->constrained("courses","course_id")->onDelete("cascade");

            // Not mandatory
            $table->date("registration_date")->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_participants');
    }
};
