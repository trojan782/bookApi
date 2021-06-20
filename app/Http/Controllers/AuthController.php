<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return response(201, $response);
    }
}
