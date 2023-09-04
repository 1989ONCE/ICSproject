<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Group;
use App\Models\Power;
use App\Models\Notify;
use App\Models\Alarm;
use App\Models\agJoin;
use App\Exports\PowersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Notifications\Warning;

class WarnController extends Controller
{
    
    public function sendWarningNotification()
    {
        $user = User::first();

        $warningData = [
            'body' => 'You received an new warning notification',
            'text' => 'There is something wrong',
            'url' => url('/'),
            'thankyou' => 'Go to check out'
        ];

        $user->notify(new Warning($warningData));
    }
    
    public function index(): View
    {
        $users = User::get();
        $groups = Group::get();
        $notify = Notify::get();
        return view('warn.warning', [
            'all_users' => $users,
            'all_groups' => $groups,
            'all_notify' => $notify,
        ]);
    }  

    public function powerStatus(): String
    {
        $status = Power::all();
        return json_encode($status);
    }

    public function status(): View
    {
        return view('warn.status');
    }

    public function export() 
    {
        $currentDate = date('Y-m-d');
        return Excel::download(new PowersExport, 'power_status_'.$currentDate.'.xlsx');
    }

    /**
     * Group Manage.
     */
    public function group(Request $request): View
    {
        $ags = agJoin::get();
        if(Alarm::get()){
            $alarms = Alarm::get();
        }
        else{
            $alarms = null;
        }
        $label = $ags->groupBy('fk_alarm_id');
        $users = User::get();
        $groups = Group::get();
        return view('warn.group', [
            'ags' => $ags,
            'all_users' => $users,
            'groups' => $groups,
            'all_labels' => $label,
            'no_label' => $label,
            'all_alarms' => $alarms,
            'search' => "",
        ]);
    }

    /**
     * Query Warning List.
     */
    public function query(Request $request): View
    {
        $search = $request->search;
        if($search == "*"){
            $ags = agJoin::get();
            $alarms = Alarm::get();
            $label = $ags->groupBy('fk_alarm_id');
            $users = User::get();
            $groups = Group::get();
            
            return view('warn.group', [
                'ags' => $ags,
                'all_users' => $users,
                'groups' => $groups,
                'all_labels' => $label,
                'no_label' => $label,
                'all_alarms' => $alarms,
                'search' => $search,
            ]);
        }
        else{
            $ags = agJoin::where('fk_alarm_id', $search)->get();
            $alarms = Alarm::get();
            $label = $ags->groupBy('fk_alarm_id');
            $users = User::get();
            $groups = Group::get();
            
            return view('warn.group', [
                'ags' => $ags,
                'all_users' => $users,
                'groups' => $groups,
                'all_labels' => $label,
                'all_alarms' => $alarms,
                'search' => $search,
            ]);
        }
    }

    /**
     * Remove selected user from ajJoin Table.
     */

    public function destroyUser(Request $request): RedirectResponse
    {

        $id = $request->user_id;
        $alarm_id = $request->alarm_id;
        agJoin::where('fk_user_id', '=', $id)->where('fk_alarm_id', '=', $alarm_id)->delete();
  
        return Redirect::route('add', ['id' => $alarm_id])->with('success', '已成功移除員工');
    }

     /**
     * Remove selected group from agJoin Table.
     */

    public function destroyGroup(Request $request): RedirectResponse
    {

        $id = $request->group_id;
        $alarm_id = $request->alarm_id;

        agJoin::where('fk_group_id', '=', $id)->where('fk_alarm_id', '=', $alarm_id)->delete();
  
        return Redirect::route('add', ['id' => $alarm_id])->with('success', '已成功移除職位群組');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request): View
    {
        $id = $request->id;
        $alarm = Alarm::where('alarm_id', '=', $id)->first();
        $already = agJoin::where('fk_alarm_id', '=', $id)->get();
        $group = Group::get();
        $user = User::get();

        $havegroup = [];
        $haveuser = [];
        for($i = 0; $i < count($already); $i++){
            if($already[$i]->fk_group_id){
                array_push($havegroup, $already[$i]->fk_group_id);
            }
        }
        for($i = 0; $i < count($already); $i++){
            if($already[$i]->fk_user_id){
                array_push($haveuser, $already[$i]->user->id);
            }
        }
        for($i = 0; $i < count($user); $i++){
            if(in_array($user[$i]->group->group_id , $havegroup)){
                array_push($haveuser, $user[$i]->id);
            }
        }

        // dump($haveuser);

        return view('warn.add', [
            'alarm' => $alarm,
            'already' => $already,
            'group' => $group,
            'havegroup' => $havegroup,
            'user' => $user,
            'haveuser' => $haveuser,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(Request $request): RedirectResponse
    {
        $user_id = $request->id;
        $alarm_id = $request->alarm_id;
        $alarm = Alarm::where('alarm_id', '=', $alarm_id)->first();

        // ajJoin create
        $agJoin = agJoin::create([
            'ag_join_name' => $alarm->alarm_name,
            'fk_alarm_id' => $alarm_id,
            'fk_user_id' => $user_id
        ]);
        $agJoin->save();
        
        return Redirect::route('add', ['id' => $alarm_id])->with('success', '已成功加入員工');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeGroup(Request $request): RedirectResponse
    {
        $group_id = $request->id;
        $alarm_id = $request->alarm_id;
        $alarm = Alarm::where('alarm_id', '=', $alarm_id)->first();

        // ajJoin create
        $agJoin = agJoin::create([
            'ag_join_name' => $alarm->alarm_name,
            'fk_alarm_id' => $alarm_id,
            'fk_group_id' => $group_id
        ]);
        $agJoin->save();

        $user = User::where('fk_group_id', '=', $group_id)->get();
        for($i = 0; $i < count($user); $i++){
            agJoin::where('fk_user_id', '=', $user[$i]->id)->where('fk_alarm_id', '=', $alarm_id)->delete();
        }
        
        return Redirect::route('add', ['id' => $alarm_id])->with('success', '已成功加入職位群組');
    }
  
}
