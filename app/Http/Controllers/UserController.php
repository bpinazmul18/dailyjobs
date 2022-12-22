<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show register/ create form

    public function create() {
        return view('users.register');
    }
}