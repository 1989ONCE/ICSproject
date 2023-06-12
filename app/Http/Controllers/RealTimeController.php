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

//     read csv
        $filePath = public_path('csv/data.csv');
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $rts = [];
        while ($row = fgetcsv($file)) {
            $rts[] = array_combine($header, $row);
        }

        // dump($rts[count($rts)-1]);
        // $last = $rts[0] + $rts[count($rts)-1];
        fclose($file);



        return view('realtime.data', [
            'all_datas' => $datas,
            'rts' => $rts,
        ]);
    }  

    // public function saveCsv()
    // {

    // }

    // public function readCsv(): View
    // {
    //     $filePath = storage_path('public/data.csv');
    //     $file = fopen($filePath, 'r');

    //     $header = fgetcsv($file);

    //     $rts = [];
    //     while ($row = fgetcsv($file)) {
    //         $rts[] = array_combine($header, $row);
    //     }

    //     fclose($file);

    //     return view('realtime.data', [
    //         'rts' => $rts,
    //     ]);
    // }
}