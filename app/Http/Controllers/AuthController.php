<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register(Request $request) {
        $fields = $request->validate([
            'name'=>'required',
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $user = User::create([
            'name'=> $fields['name'],
            'email'=> $fields['email'],
            'password'=> bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response, 201);
        // return response()->json($response);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields   ['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response, 201);

    }


    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return [
            'message'=>'Logged out'
        ];
    }
}
