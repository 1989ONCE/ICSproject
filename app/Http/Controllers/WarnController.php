<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('warn.warning');
    }  
}