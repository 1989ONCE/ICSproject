<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return Excel::download(new PowersExport, 'power_status.xlsx');
    }

    /**
     * Group Manage.
     */
    public function group(Request $request): View
    {
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
        if($search == null){
            $ags = agJoin::get();
        }
        else{
            $ags = agJoin::where('fk_alarm_id', $search)->get();
        }
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

    /**
     * Remove selected user from ajJoin Table.
     */
    public function destroyUser(Request $request)
    {

        $id = $request->user_id;
        $alarm_id = $request->alarm_id;
        agJoin::where('fk_user_id', '=', $id)->where('fk_alarm_id', '=', $alarm_id)->delete();
  
        return redirect(route('warning.group'))->with('alert', ' 已將該員工從此告警群組移除！' );
    }

     /**
     * Remove selected group from agJoin Table.
     */
    public function destroyGroup(Request $request)
    {

        $id = $request->group_id;
        $alarm_id = $request->alarm_id;
        agJoin::where('fk_group_id', '=', $id)->where('fk_alarm_id', '=', $alarm_id)->delete();
  
        return redirect(route('warning.group'))->with('alert', ' 已將職位的所有員工移除！' );
    }
  
}
