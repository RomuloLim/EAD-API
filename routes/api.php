<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\ReplySupportController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'find']);

Route::get('/course/{id}/modules', [ModuleController::class, 'index']);

Route::get('/module/{id}/lessons', [LessonController::class, 'index']);
Route::get('/lesson/{id}', [LessonController::class, 'show']);

Route::get('/my-supports', [SupportController::class, 'getUserSupports']);
Route::get('/supports', [SupportController::class, 'index']);

Route::post('/supports', [SupportController::class, 'store']);

Route::post('/replies', [ReplySupportController::class, 'store']);
