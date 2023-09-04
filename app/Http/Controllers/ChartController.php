<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Datas;
use App\Exports\DatasExport;
use App\Exports\DrugsExport;
use Maatwebsite\Excel\Facades\Excel;

class ChartController extends Controller
{
    public function index(): View
    {
        return view('chart.curve');
    }  

    public function export() 
    {
        $currentDate = date('Y-m-d');
        return Excel::download(new DatasExport, 'historical_report_'.$currentDate.'.xlsx');
    }

    public function export2() 
    {
        $currentDate = date('Y-m-d');
        return Excel::download(new DrugsExport, 'drug_report_'.$currentDate.'.xlsx');
    }

    // generate linechart
    public function linechart(): String
    {
        $T01_15_ph = Datas::all(['T01_15_ph'])->toJson();
        $T01_15_temp = Datas::all(['T01_15_temp'])->toJson();
        $T01_15_ec = Datas::all(['T01_15_ec'])->toJson();
        $T01_15_cod = Datas::all(['T01_15_cod'])->toJson();
        $added_on = Datas::all(['added_on'])->toJson();

    	return json_encode(
            [$T01_15_ph, $T01_15_temp, $T01_15_ec, $T01_15_cod, $added_on]
        );
    }

    public function linechart2(): String
    {
        $T01_2_drug = Datas::all(['T01_2_drug'])->toJson();
        $T01_4_drug = Datas::all(['T01_4_drug'])->toJson();
        $T01_5_drug1 = Datas::all(['T01_5_drug1'])->toJson();
        $T01_5_drug2 = Datas::all(['T01_5_drug2'])->toJson();
        $T01_6_drug = Datas::all(['T01_6_drug'])->toJson();
        $T01_12_drug1 = Datas::all(['T01_12_drug1'])->toJson();
        $T01_12_drug2 = Datas::all(['T01_12_drug2'])->toJson();
        $T01_13_drug = Datas::all(['T01_13_drug'])->toJson();

        $added_on = Datas::all(['added_on'])->toJson();

    	return json_encode(
            [$T01_2_drug, $T01_4_drug, $T01_5_drug1, $T01_5_drug2, $T01_6_drug, 
             $T01_12_drug1, $T01_12_drug2, $T01_13_drug, $added_on
            ]);
    }
}