<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

// Reroute to the view that is used
Route::get('/', function () {
    return redirect()->route('participants.index');
});

Route::resource("participants", ParticipantController::class);
Route::resource('courses', CourseController::class);

Route::post('/enrollments', [EnrollmentController::class, 'enroll'])->name('enrollments.store');
Route::delete('/enrollments/{course}/{participant}', [EnrollmentController::class, 'discharge'])->name('enrollments.destroy');
