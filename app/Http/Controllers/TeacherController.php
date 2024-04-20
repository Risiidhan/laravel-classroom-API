<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate(10);
        if ($teachers->count() > 0) {
            return response()->json([
                'status' => 200,
                'data' => $teachers
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
            $teacher = Teacher::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
            ]);

            if ($teacher) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Teacher created successfully',
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
        $teacher = Teacher::find($id);
        if ($teacher) {
            return response()->json([
                'status' => 200,
                'data' => $teacher->load('courses') 
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
        $teacher = Teacher::find($id);
        if ($teacher) {
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
                $teacher->name = $request->name;
                $teacher->email = $request->email;
                $teacher->gender = $request->gender;
                $teacher->save();
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Teacher updated successfully',
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
        $teacher = Teacher::find($id);
        if ($teacher) {
            $teacher->delete();

            return response()->json([
                'status' => 200,
                'data' => 'Teacher deleted successfully'
            ], 404);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'No Record Found'
            ], 404);
        }
    }
}
