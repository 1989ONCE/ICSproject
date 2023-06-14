<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\User;
use App\Models\Group;

=======
use App\Notifications\Warning;
>>>>>>> 818154f3f17b18cf8f01f82452c3791778102fce

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
}