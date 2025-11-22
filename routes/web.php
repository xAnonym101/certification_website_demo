<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CourseController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource("participants", ParticipantController::class);
Route::resource('courses', CourseController::class);
