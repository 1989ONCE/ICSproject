<?php

namespace App\Http\Controllers;

use App\Console\Commands\rtCommand;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Datas;
use App\Models\Prediction;
use App\Models\Ai_model;
use Illuminate\Support\Facades\Artisan;

class RealTimeController extends Controller
{

    public function index(): View
    {
        $model = Ai_model::all();

        return view('realtime.data', [
            'models' => $model,
            'option' => '',
        ]);
    } 

    public function rtdata(Request $request): String
    {
        $rts = Datas::orderBy('data_id', 'desc')->first();
        
        return json_encode([
            'rts' => $rts,
        ]);
    }

    public function option(Request $request): String
    {
        $id = $request->option;
        if($id == null){
            $pred = Prediction::orderBy('added_on', 'desc')->orderBy('fk_model_id', 'asc')->first();
        }
        else{
            $pred = Prediction::where('fk_model_id', '=', $id)->orderBy('added_on', 'desc')->first();
        }
        
        return json_encode([
            'pred' => $pred,
        ]);
    }

    public function predictData(Request $request): View
    {
        $model = Ai_model::all();
        $id = $request->option;

        if($id == ''){
            $pred = Prediction::orderBy('added_on', 'desc')->orderBy('fk_model_id', 'asc')->first();
            $option = '';
        }
        else{
            $pred = Prediction::where('fk_model_id', '=', $id)->orderBy('added_on', 'desc')->first();
            $option = $id;
        }

        return view('realtime.data', [
            'pred' => $pred,
            'models' => $model,
            'option' => $option,
        ]);
    }
}

