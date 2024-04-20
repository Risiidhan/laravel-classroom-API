<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'data' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'No Record Found'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'gender' => 'required|string|max:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid input',
                'error' => $validator->messages()
            ], 400);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Student created successfully',
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
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'data' => $student->load('courses') 
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'No Record Found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'gender' => 'required|string|max:10'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid input',
                    'error' => $validator->messages()
                ], 400);
            } else {
                $student->name = $request->name;
                $student->email = $request->email;
                $student->gender = $request->gender;
                $student->save();
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Student updated successfully',
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
        $student = Student::find($id);
        if ($student) {
            $student->delete();

            return response()->json([
                'status' => 200,
                'data' => 'Student deleted successfully'
            ], 404);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'No Record Found'
            ], 404);
        }
    }
}
