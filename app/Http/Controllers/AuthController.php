<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //To register a new user
    public function register(Request $request) {
        //To validate the user's credentials
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:4|confirmed'
        ]);

        //To create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $response = [
            'user' => $user,
            'message' => 'you have been registered successfully!🎉'
        ];
        return response($response, 201);
    }

    //Function to login the user
    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Email check
        $user = User::where('email', $data['email'])->first();

        //password check
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Invalid Credentials ❌'
            ], 401);
        }
        else {
            return response(['message' => 'You have logged in successfully!👋🏼'], 201);
        }
    }
}