<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)) 
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "status" => 'login success',
                "data" => $success
            ]);
        }
    }

    public function logout() {
        return Auth::user()->tokens()->delete();
    }
}
