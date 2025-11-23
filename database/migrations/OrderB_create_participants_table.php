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
        // The code to migrate participants table
        Schema::create('participants', function (Blueprint $table) {
            // Custom id name
            $table->id("participant_id");

            // Mandatory fillable
            $table->string("full_name");
            // Unique for only 1 exists in the whole database
            $table->string("email")->unique();
            $table->string("phone_number");
            $table->string("address");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
