<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\View\View;

use Illuminate\Support\Facades\DB;
use App\Models\Alarm;
use App\Http\Controllers\Auth;

class AlarmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Alarms = Alarm::paginate(5);
        return view(('warn.check'), ['alarms'=> $Alarms]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $alarms = Alarm::where(function($query) use($search){
            $query->where('alarm_name','like',"%$search%");

            
        })
        ->paginate(5);
        return view(('warn.check'),['alarms'=> $alarms,'search'=>$search]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Alarm_Name = $request->input('type');
        $operator = $request->input('operator');
        $number = $request->input('number');

        if($Alarm_Name == "ph" ){
            
            if ($operator == ">"){
                $Alarm_Name = "ph值過高";
            }elseif($operator == "<"){
                $Alarm_Name = "ph值過低";
            }else{
                $Alarm_Name = "ph為$number";
            }
            
        }elseif($Alarm_Name == "溫度"){
            if ($operator == ">"){
                $Alarm_Name = "溫度過高";
            }elseif($operator == "<"){
                $Alarm_Name = "溫度過低";
            }else{
                $Alarm_Name = "溫度為$number";
            }

        }elseif($Alarm_Name == "導電度"){
            if ($operator == ">"){
                $Alarm_Name = "導電度過高";
            }elseif($operator == "<"){
                $Alarm_Name = "導電度過低";
            }else{
                $Alarm_Name = "導電度為$number";
            }
        }elseif($Alarm_Name == "COD"){
            if ($operator == ">"){
                $Alarm_Name = "COD過高";
            }elseif($operator == "<"){
                $Alarm_Name = "COD過低";
            }else{
                $Alarm_Name = "COD為$number";
            }
        }
        elseif($Alarm_Name == "SS"){
            if ($operator == ">"){
                $Alarm_Name = "SS過高";
            }elseif($operator == "<"){
                $Alarm_Name = "SS過低";
            }else{
                $Alarm_Name = "SS為$number";
            }
        }

        DB::table('Alarms')->insert([
            'alarm_name' => $Alarm_Name,
            'alarm_type' => $request->input('type'),
            'operator' => $request->input('operator'),
            'alarm_num' => $request->input('number'),
            'fk_notify_id' => $request->input('notify')
        ]);

        
        $Alarm_id =  DB::table('alarms')->latest('alarm_id')->value('alarm_id');
       
        foreach ($request->input('group_id') as $key =>$group_id){
            DB::table('ag_joins')->insert([
                'ag_join_name' => $Alarm_Name,
                'fk_alarm_id' => $Alarm_id,
                'fk_group_id' => $group_id
            ]);
        };

        foreach ($request->input('user_id') as $key =>$user_id){
            DB::table('ag_joins')->insert([
                'ag_join_name' => $Alarm_Name,
                'fk_alarm_id' => $Alarm_id,
                'fk_user_id' => $user_id
            ]);
        };

        /*
        //$Alarm_id = $Alarm_id + 1;
        DB::table('ag_joins')->insert([
            'ag_join_name' => $Alarm_Name,
            'fk_alarm_id' => $Alarm_id,
            'fk_group_id' => $request->input('group_id'),
            'fk_user_id' => $request->input('user_id')
        ]);
        */

        return redirect(route('warning'))->with('alert', ' 新增成功！' );
    }

    /**
     * Display the specified resource.
     */
    //string $id
    public function show()
    {
        return view('warn.alarm');
    }


    public function edit(Request $request){
        //$alarm = Alarm::where('alarm_id')->find($id);
        $id = $request->id;
        //$alarm = "SELECT * FROM `alarms` WHERE `alarm_id` = $id limit 1";
        $alarm = DB::table('alarms')->where('alarm_id',$id)->first();

        $all_users = DB::table('users')->get();
        $all_groups = DB::table('groups')->get();

        $selecteds = DB::table('ag_joins')->where('fk_alarm_id',$id)->get();
        
        return view(('warn.edit'),['alarm' => $alarm,'all_users'=>$all_users,'all_groups'=>$all_groups,'selecteds'=>$selecteds]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $Alarm_Name = $request->input('type');
        $operator = $request->input('operator');
        $number = $request->input('number');
        
        
        $alarm = DB::table('alarms')->where('alarm_id',$id)-> update([
            'alarm_name' => $Alarm_Name,
            'alarm_type' => $request->type,
            'operator' => $request->operator,
            'alarm_num' => $request->number,
            'fk_notify_id' => $request->notify
        ]);
        
       

        $ag = DB::table('ag_joins')->where('fk_alarm_id',$id)->delete();
        foreach ($request->input('group_id') as $key =>$group_id){
            DB::table('ag_joins')->insert([
                'ag_join_name' => $Alarm_Name,
                'fk_alarm_id' => $id,
                'fk_group_id' => $group_id
            ]);
        };

        foreach ($request->input('user_id') as $key =>$user_id){
            DB::table('ag_joins')->insert([
                'ag_join_name' => $Alarm_Name,
                'fk_alarm_id' => $id,
                'fk_user_id' => $user_id
            ]);
        };


        //$alarm -> update($request);
        return redirect(route('warning.check'))->with('alert', ' 編輯成功！' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $id = $request->id;
        $alarm = DB::table('alarms')->where('alarm_id',$id)->delete();
  
        return redirect(route('warning.check'))->with('alert', ' 已刪除！' );
    }





}
