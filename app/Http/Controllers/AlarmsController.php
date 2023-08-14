<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Group;
use App\Models\Alarm;
use App\Models\agJoin;
use App\Models\Notify;

class AlarmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $notify = Notify::get();
        $Alarms = Alarm::paginate(5);
        return view(('warn.check'), [
            'alarms'=> $Alarms,
            'notifys' => $notify,
            'search' => "",
        ]);
    }

    /**
     * Query alarm list.
     */
    public function search(Request $request): View
    {
        $notify = Notify::get();
        $search = $request->search;
        if($search == null){
            $alarms = Alarm::paginate(5);
        }
        else{
            $alarms = Alarm::query()
                ->where('alarm_type', 'LIKE', "%{$search}%") 
                ->paginate(5);
        }
        return view(('warn.check'), [
            'alarms'=> $alarms,
            'notifys' => $notify,
            'search' => $search,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate request value
        $request->validate([
            'type' => ['required', 'string'],
            'operator' => ['required', 'string'],
            'number' => ['required', 'numeric'],
            'notify' => ['required', 'numeric'],
            'group_id' => ['array'],
            'user_id' => ['array'],
        ]);

        // alarm create
        $Alarm_Name = $request->type." ".$request->operator." ".$request->number;
        $alarm = Alarm::create([
            'alarm_name' => $Alarm_Name,
            'alarm_type' => $request->type,
            'operator' => $request->operator,
            'alarm_num' => $request->number,
            'fk_notify_id' => $request->notify,
        ]);
        $alarm->save();

        // ajJoin create
        $Alarm_id =  Alarm::latest('alarm_id')->value('alarm_id');
        if($request->user_id != null){
            for($i = 0; $i < count($request->user_id); $i++){
                $agJoin = agJoin::create([
                    'ag_join_name' => $Alarm_Name,
                    'fk_alarm_id' => $Alarm_id,
                    'fk_user_id' => $request->user_id[$i],
                ]);
                $agJoin->save();
            }
        }
        if($request->group_id != null){
            for($i = 0; $i < count($request->group_id); $i++){
                $agJoin = agJoin::create([
                    'ag_join_name' => $Alarm_Name,
                    'fk_alarm_id' => $Alarm_id,
                    'fk_group_id' => $request->group_id[$i],
                ]);
                $agJoin->save();
            }
        }
        return Redirect::route('warning')->with('alert', ' 新增成功！' );
    }

    /**
     * Show edit view for the alarm form.
     */
    public function edit(Request $request): View
    {
        $id = $request->id;
        $alarm = Alarm::where('alarm_id', '=', $id)->first();
        $users = User::get();
        $groups = Group::get();
        $notify = Notify::get();

        return view('warn.edit', [
            'alarm' => $alarm,
            'all_users' => $users,
            'all_groups' => $groups,
            'all_notify' => $notify,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $id = $request->id;
        
        $request->validate([
            'type' => ['string'],
            'opertor' => ['string'],
            'number' => ['numeric'],
            'notify' => ['numeric'],
        ]);
        $Alarm_Name = $request->type." ".$request->operator." ".$request->number;

        Alarm::where('alarm_id', '=', $id)->update([
            'alarm_name' => $Alarm_Name,
            'alarm_type' => $request->type,
            'operator' => $request->operator,
            'alarm_num' => $request->number,
            'fk_notify_id' => $request->notify,
        ]);
        return Redirect::route('warning.check')->with('alert', '編輯成功！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $id = $request->id;
        Alarm::where('alarm_id', '=', $id)->delete();
  
        return redirect(route('warning.check'))->with('alert', ' 已刪除！' );
    }
}
