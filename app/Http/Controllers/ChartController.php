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
        $T01_6_ph = Datas::all(['T01_6_ph'])->toJson();
        $T01_6_ss = Datas::all(['T01_6_ss'])->toJson();

        $T01_12_ph = Datas::all(['T01_12_ph'])->toJson();
        $T01_14_ph = Datas::all(['T01_14_ph'])->toJson();

        $added_on = Datas::all(['added_on'])->toJson();

    	return json_encode(
            [$T01_6_ph, $T01_6_ss, $T01_12_ph, $T01_14_ph, $added_on]
        );
    }

    public function linechart2(): String
    {
        $T01_12_drug1_current = Datas::all(['T01_12_drug1_current'])->toJson();
        $T01_12_drug2_current = Datas::all(['T01_12_drug2_current'])->toJson();

        $added_on = Datas::all(['added_on'])->toJson();

    	return json_encode(
            [$T01_12_drug1_current, $T01_12_drug2_current, $added_on]);
    }
}