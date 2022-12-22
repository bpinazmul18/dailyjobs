<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show register/ create form
    public function create() {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        // Hash password
        $validateData['password'] = bcrypt($validateData['password']);
        
        // Create User
        $user = User::create($validateData);

        // Login
        auth()->login($user);
        return redirect('/')->with('message', 'User created and logged in.');
    }
}