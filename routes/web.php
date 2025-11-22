<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CourseController;

// Reroute to the view that is used
Route::get('/', function () {
    return redirect()->route('participants.index');
});

Route::resource("participants", ParticipantController::class);
Route::resource('courses', CourseController::class);

Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
Route::delete('/courses/{course}/discharge/{participant}', [CourseController::class, 'discharge'])->name('courses.discharge');
