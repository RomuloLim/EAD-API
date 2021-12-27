<?php

use App\Http\Controllers\Api\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course/{id}', [CourseController::class, 'find'])->name('courses.find');
