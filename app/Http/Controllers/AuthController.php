<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/', 'max:255'],
            'last_name' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8 '
       ]);

       $user = User::create([
        'first_name'=> $request->first_name,
        'last_name'=> $request->last_name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
        
       ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully!', $token,
            // 'access_token'=> $token,
            // 'toen_type'=>Bearer,

        ],201);

    //    return redirect('/');

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8 '
        ]);
        
        $user = User::where('email',$request->email)->first();

        if(! $user || !Hash::check($request->password, $user->password)) {
            Throw ValidationException::withMessages(['email'=> 'email or password is incorrect']);
        };
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully!',
            'access_token' => $token,
            'token_type'=>'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully!',
        ]);
    }

        public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
