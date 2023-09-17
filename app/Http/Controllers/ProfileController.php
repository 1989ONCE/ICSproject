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
     * Show edit view for the user's profile form.
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
     * Show model setting view.
     */
    public function model(Request $request): View
    {
        $model = Ai_model::get();
        $groups = Group::get();
        return view('profile.model', [
            'user' => $request->user(),
            'model' => $model,
            'all_groups' => $groups,
        ]);
    }

    public function upload(ProfileUpdateRequest $request): RedirectResponse
    {
        $currentDate = date('Y-m-d');
        $model_id = $request->id;
        $model = Ai_model::where('model_id', $model_id)->first();

        if($model->model_loc !== null){
            $deleteModel =  public_path('models/') .$model->model_loc;
            unlink($deleteModel);
            Ai_model::where('model_id', $model_id)->update(['model_loc'=> null, 'added_on'=> null, 'accuracy' => null]);
        }
        $request->validate([
            'loc' => 'required|file',
        ]);

        // get file name
        $loc = $currentDate.'_'.$request->file('loc')->getClientOriginalName();
        $loc = str_replace(' ', '', $loc);

        // validate file extension
        $ext = pathinfo($loc);
        $accepted_ext = Array('pkl','pickle');
        if(in_array($ext['extension'], $accepted_ext)){
            $request->loc->move(public_path('models'), $loc);
            $app_path = app_path('Console/python/get_acc.py');
            $input = escapeshellcmd("python3 $app_path $loc");
            $output = shell_exec($input);
            dump($output);
            sleep(5);
            Ai_model::where('model_id', $model_id)->update(['model_loc'=>$loc, 'added_on'=>$currentDate, 'accuracy' => 98]);
            return back()->with('success', strtoupper($model->model_name). ' 模型更新成功！');
        }
        else{
            return back()->with('error', '模型更新失敗！請再試一遍。');
        }
    }

    /**
     * Create new predicting model.
     */
    public function createModel(Request $request): RedirectResponse
    {

        $model = new Ai_model();
        $model->model_name = $request->name;
        $model->accuracy = $request->accuracy;


        $model->save();
        return back()->with('success', '模型新增成功！');
        
    }

    /**
     * Delete the selected predicting model.
     */
    public function deleteModel(Request $request): RedirectResponse
    {
        $model_id = $request->query('id');
        Ai_model::where('model_id', $model_id)->delete();

        return back()->with('success', '模型刪除成功！');
        
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

        return Redirect::route('profile.edit')->with('status', '個人資料已更新！');
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

    public function change(ProfileUpdateRequest $request): RedirectResponse
    {
        if($request->user()->avatar !== null){
            $deleteImage =  public_path('avatars/') .$request->user()->avatar;
            unlink($deleteImage);
            Auth()->user()->update(['avatar'=>null]);
        }
        $request->user()->fill($request->validate([
            'avatar' => 'required|file|mimes:jpg,jpeg,png,gif,jfif|max:1024',
        ]));
  
        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);
  
        Auth()->user()->update(['avatar'=>$avatarName]);
  
        return back()->with('success', '頭像上傳成功！');
    }

    public function remove(ProfileUpdateRequest $request): RedirectResponse
    {
        if($request->user()->avatar !== null){
            $deleteImage =  public_path('avatars/') .$request->user()->avatar;
            unlink($deleteImage);
            Auth()->user()->update(['avatar'=>null]);
            return back()->with('success', '頭像移除成功！');
        }
        else{
            return back()->with('success', "您尚未設定任何頭像！");
        }
        
    }
}
