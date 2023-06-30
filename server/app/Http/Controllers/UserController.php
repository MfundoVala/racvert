<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
        public function login(Request $request)
    {
        // Validate the phone number

        $request->validate([
            'phone' => 'required|numeric|min:10'
        ]);

        // find or create the user

        $user = User::where('phone', $request->phone)
                    ->where('username', $request->username)
                    ->first();
        $token = $user->createToken('auth_token')->plainTextToken;


        if ($user) {
        // send otp
        if (!$user->active) {
            return response()->json([
                'status' => 'success',
                'message' => 'User not active',
                'user' => $user,
                'token' => $token,
            ], 200);
        }
        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $user,
        ]);
        }

        return response()->json([
                'status' => 'error', 
                'message' => 'User not found',
            ], 401);


    }

    public function register(Request $request) {
        // Validate the phone number

        $request->validate([
            'phone' => 'required|numeric|min:10'
        ]);

        // find or create the user
        $user_exists = User::where('phone', $request->phone)
                            ->orWhere('username', $request->username)
                            ->first();

        if ($user_exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'User already exists',
            ], 401);
        }

        $user = new User;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->save();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'There has been an error creating the user',
            ], 401);
        }



        // send otp
        $token = $user->createToken('auth_token')->plainTextToken;

        // return response
        return response()->json([
            'message' => 'ok',
            'token' => $token,
            'user' => $user,
        ], 200);
    }
}
