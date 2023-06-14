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

class ProfileController extends Controller
{
    /**
     * Get the user's profile.
     */
    public function show(Request $request): View
    {
        $groups = Group::get();
        return view('profile.show', [
            'user' => $request->user(),
            'all_groups' => $groups,
        ]);
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
        return view('profile.group', [
            'user' => $request->user(),
            'all_users' => $users,
            'groups' => $groups,
            'all_labels' => $label,
            'all_alarms' => $alarms,
        ]);
    }

    /**
     * Edit the user's profile form.
     */
    public function edit(Request $request): View
    {
        $groups = Group::get();
        return view('profile.edit', [
            'user' => $request->user(),
            'all_groups' => $groups,
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $req = 'required';
        if($request->user()->email == $request->email){
            $request->request->remove('email');
            $req = null;
        }

        $request->user()->fill($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/09[0-9]{8}/'],
            'email' => [$req, 'string', 'email', 'max:255', 'unique:'.User::class],
            'fk_group_id' => ['required', 'int'],
        ]));


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
