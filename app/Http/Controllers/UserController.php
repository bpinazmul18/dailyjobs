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


    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Successfully logout!');
    }

    public function login() {
        return view('users.login');
    }


    public function auth (Request $request) {
        $validateData = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($validateData)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'User Successfully logged in.');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}