<?php

namespace App\Http\Controllers;

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
    }
}
