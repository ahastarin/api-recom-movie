<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "status" => 'login success',
                "user" => $user->name,
                "data" => $success,
            ]);
        } else {
            return response()->json([
                "status" => 'login failed email / password is incorect',
                "data" => [
                    "token" => null,
                ]
            ]);
        }
    }

    public function logout()
    {
        return Auth::user()->tokens()->delete();
    }
}
