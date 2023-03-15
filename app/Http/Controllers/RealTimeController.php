<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealTimeController extends Controller
{
    public function index()
    {
        return view('realtime.data');
    }  
}