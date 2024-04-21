<?php

use App\Http\Controllers\CourcesController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseStudentController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('teachers', TeacherController::class);
    Route::post('/course_student/{courseId}/{studentId}', [CourseStudentController::class, 'store']);
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



