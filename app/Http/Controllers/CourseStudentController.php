<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{

    public function index()
    {
        return 'ji';
    }
    public function store($courseId, $studentId)
    {
        // Retrieve the course and student models
        $course = Course::find($courseId);
        $student = Student::find($studentId);
    
        // Check if both models exist
        if (!$course || !$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course or student not found',
            ], 404);
        }
    
        // Attach the student to the course
        $course->students()->attach($student);
        
    
        return response()->json([
            'status' => 'success',
            'message' => 'Student added to course successfully',
        ]);
    }
    
}
