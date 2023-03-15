<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarnController extends Controller
{
    public function index()
    {
        return view('warn.warning');
    }  
}