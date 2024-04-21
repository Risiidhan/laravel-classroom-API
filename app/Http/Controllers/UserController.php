<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid input',
                'error' => $validator->messages()
            ], 400);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Student updated successfully',
            ], 200);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid input',
                'error' => $validator->messages()
            ], 400);
        } else {
            if (Auth::attempt($request->only('email', 'password'))) {
                $token = Auth::user()->createToken('authToken')->plainTextToken;
                return response()->json([
                    'status'=> 200,
                    'message' => 'Logged In Successfully',
                    'token' => $token
                ], 200);
            } else {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        }
    }
}
