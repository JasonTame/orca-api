<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login successful!',
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid login credentials!',
            ], 401);
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'Successfully logged out!',
        ]);
    }

    public function user()
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }
}
