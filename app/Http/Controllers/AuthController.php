<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Hash; // Bcrypt hashing
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect(Request $request): RedirectResponse
    {
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect('/');
    }
}
