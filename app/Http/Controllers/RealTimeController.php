<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Datas;

class RealTimeController extends Controller
{

    public function index(): View
    {
        $datas = Datas::all();
        return view('realtime.data', [
            'all_datas' => $datas,
        ]);
    }  
}