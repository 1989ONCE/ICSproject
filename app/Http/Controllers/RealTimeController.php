<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Datas;
use App\Models\Testdatas;

class RealTimeController extends Controller
{

    public function index(): View
    {
        $datas = Datas::all();
        return view('realtime.data', [
            'all_datas' => $datas,
        ]);
    } 

    public function rtdata(): String
    {
        $rts = Testdatas::orderBy('testdata_id', 'desc')->first();
        return json_encode($rts);
    }
}

