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
        $ph_1 = Datas::select('ph')->where('data_id', '1')->get()->count();
        $ph_2 = Datas::select('ph')->where('data_id', '2')->get()->count();
        $ph_3 = Datas::select('ph')->where('data_id', '3')->get()->count();
        $ph_4 = Datas::select('ph')->where('data_id', '4')->get()->count();
        return view('chart.curve', [
            'ph_1' => $ph_1,
            'ph_2' => $ph_2,
            'ph_3' => $ph_3,
            'ph_4' => $ph_4,
        ]);
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

    // generate linechart
    public function linechart(Request $request)
    {
    	$ph_1 = Datas::all()->groupBy('ph'); 

    	// $temp = Product::where('product_type','phone')->where('year','2019')->get()->count();
    	// $EC = Product::where('product_type','phone')->where('year','2020')->get()->count();  
        // $COD = Product::where('product_type','phone')->where('year','2019')->get()->count(); 	
    	    	    	
    	return view('linechart',compact('phone_count_18','phone_count_19','phone_count_20','laptop_count_18','laptop_count_19','laptop_count_20','tablet_count_18','tablet_count_19','tablet_count_20'));
    }
}