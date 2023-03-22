<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Hash; // Bcrypt hashing
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('realtime'); // 登入後首頁: realtime實時圖控
        }
        return view('index'); //未登入首頁: index
    }  
       
    public function loginpage()
    {
        if(Auth::check()){
            return redirect('realtime')->withSuccess("You've already signed in, redirecting you to realtime page...");
        }
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('rt')->withSuccess('You may have enter the wrong email or password!');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }
 
 
 
    public function registration()
    {
        if(Auth::check()){
            return redirect('realtime')->withSuccess("You've already had an account, redirecting you to realtime page...");
        }
        return view('auth.registration');
    }
       
 
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/09[0-9]{8}/',
            'password' => 'required|min:6',
            'group' => 'required',
        ]);
            
        $data = $request->all();
        $check = $this->create($data);
          
        return redirect("login")->withSuccess("You've registered successfully, don't forget to verify your email");
    }
 
 
    public function create(array $data)
    {
      return User::create([
        'user_name' => $data['user_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'password' => Hash::make($data['password']),
        'fk_group_id' => $data['group'],
      ]);
    }    
     
 
    public function signOut(Request $request)
    {
        Session::flush();
        Auth::logout();
        return Redirect('index');
    }
}
