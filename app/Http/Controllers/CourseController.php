<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        if($courses->count() == 0)
        {
            return response()->json([
                "status"=> "error",
                "message"=> "Not Records Found"
            ],404);
        }
        else
        {
            return response()->json([
                "status"=> "success",
                "data"=> $courses
            ],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required|string|max:100',
            'durationInMonths' => 'required|integer|max:48',
            'teacher_id' => 'required|exists:teachers,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'request' => $request,
                'status' => 400,
                'message' => 'Invalid input',
                'error' => $validator->messages()
            ], 400);
        } 
        else {
            $course = Course::create([
                'name' => $request->name,
                'durationInMonths' => $request->durationInMonths,
                'teacher_id' => $request->teacher_id
            ]);

            if ($course) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Course created successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Internal server error',
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with('teacher')->find($id);
        if ($course) {
            return response()->json([
                'status' => 200,
                'data' => $course->toArray(), 
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'No Record Found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if ($course) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'durationInMonths' => 'required|integer|max:48',
                'teacher_id' => 'required|exists:teachers,id'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid input',
                    'error' => $validator->messages()
                ], 400);
            } else {
                $course->name = $request->name;
                $course->durationInMonths = $request->durationInMonths;
                $course->teacher_id = $request->teacher_id;
                $course->save();
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Course updated successfully',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();

            return response()->json([
                'status' => 200,
                'data' => 'Course deleted successfully'
            ], 404);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'No Record Found'
            ], 404);
        }
    }
}
