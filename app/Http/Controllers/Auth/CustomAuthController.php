<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
}
