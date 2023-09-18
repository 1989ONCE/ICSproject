<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Group;
use App\Models\User;
use App\Models\agJoin;
use App\Models\Alarm;
use App\Models\Ai_model;

class AdminController extends Controller
{
    /**
     * Get all users' profile.
     */
    public function index(Request $request): View
    {
        if(Auth::user()->roles->pluck('name')[0] == 'Admin'){
            $groups = Group::get();
            $users = User::all();
            return view('admin.index', [
                'user' => $request->user(),
                'users' => $users,
                'all_groups' => $groups,
            ]);
        }
        else{
            $groups = Group::get();
            return view('profile.show', [
                'user' => $request->user(),
                'all_groups' => $groups,
            ]);
        }
    }

    public function edit(Request $request): View
    {
        if(Auth::user()->roles->pluck('name')[0] == 'Admin'){
            $editUser = User::where('id', $request->id)->get();
            $groups = Group::get();
            return view('admin.adminEdit', [
                'user' => $request->user(),
                'editUser' => $editUser[0],
                'all_groups' => $groups,
            ]);
        }
        else{
            $groups = Group::get();
            return view('profile.show', [
                'user' => $request->user(),
                'all_groups' => $groups,
            ]);
        }
    }

    /**
     * Update selected user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $req = 'required';
        $editUser = User::where('id', $request->editID)->get();
        
        if($editUser[0]->email == $request->email){
            $request->request->remove('email');
            $req = null;
        }

        $editUser[0]->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/09[0-9]{8}/'],
            'email' => [$req, 'string', 'email', 'max:255', 'unique:'.User::class],
            'fk_group_id' => ['required', 'int'],
        ]));
        


        if ($editUser[0]->isDirty('email')) {
            $editUser->email_verified_at = null;
        }

        $editUser[0]->save();
        $editFinish = User::where('id', $request->editID)->get();

        return Redirect::route('admin.edit', ['id'=> $request->editID])->with('status', 'profile-updated');
    }

    /**
     * Delete selected user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);
        $user = User::where('id', $request->id)->get();

        $user[0]->delete();

        $groups = Group::get();
        $users = User::all();
        return Redirect::route('admin.allUser', [
            'user' => $request->user(),
            'users' => $users,
            'all_groups' => $groups,
        ]);
    }
}
