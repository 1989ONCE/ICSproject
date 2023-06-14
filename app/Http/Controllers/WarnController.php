<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;


class WarnController extends Controller
{
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