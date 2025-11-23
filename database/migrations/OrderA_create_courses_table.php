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
        // The code to migrate course table
        Schema::create('courses', function (Blueprint $table) {
            // Custom id name
            $table->id("course_id");

            // Mandatory fillable
            $table->string("course_name");
            $table->text("course_description");
            $table->string("instructor_name");

            // Not mandatory
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
