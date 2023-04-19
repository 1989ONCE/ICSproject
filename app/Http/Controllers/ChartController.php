<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Datas;
use App\Exports\DatasExport;
use Maatwebsite\Excel\Facades\Excel;

class ChartController extends Controller
{
    public function index(): View
    {
        $datas = Datas::all();
        return view('chart.curve', 
        // ['ph' => $datas->ph]
    );
    }  

    public function export() 
    {
        return Excel::download(new DatasExport, 'datas.xlsx');
    }

    // public function ph_curve(Request $request)
    // {
    //     $datas = Datas::all();
    //     return ['ph', $datas->ph];
    // }
}