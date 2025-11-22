<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CourseController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource("participants", ParticipantController::class);
Route::resource('courses', CourseController::class);

Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
Route::delete('/courses/{course}/discharge/{participant}', [CourseController::class, 'discharge'])->name('courses.discharge');
