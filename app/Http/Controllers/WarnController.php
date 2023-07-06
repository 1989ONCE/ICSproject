<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Group;
use App\Models\Power;
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
    
    public function index()
    {
        $users = User::get();
        $groups = Group::get();
        return view('warn.warning', [
            'all_users' => $users,
            'all_groups' => $groups,
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
  
}
