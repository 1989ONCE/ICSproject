<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Http\RedirectResponse;
use App\Models\Group;
use App\Models\User;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Auth;


class LineController extends Controller
{
    public function show(Request $request)
    {
        $groups = Group::get();
        return view('profile.edit',[
            'user' => $request->user(),
            'all_groups' => $groups,
        ]);
    }  

    public function lineNotifyCallback(Request $request) {
        //$username = request()->get('username');
        $username = $request->input('name');
        $code = request()->get('code');
        $callbackUrl = "http://localhost/ICSproject/public/profile/linetest";

        //\DB::statement("update admin_users set line_notify_auth_code='{$code}' where username='{$username}'");

        //LINE Access Token
        //$this->getNotifyAccessToken1($username, $code, $callbackUrl);
        
        $responseData = Http::asForm()->post('https://notify-bot.line.me/oauth/token', [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $callbackUrl,
            'client_id' => 'Fmqcpg21ohTgNGSU6xo499',
            'client_secret' => 'Ab1AiyJim4QAT1KznrQqZeDPmMY6S4v0eqmYImSRhWu',
        ])->json();

        $accessToken = Arr::get($responseData, 'access_token');

        $responseData = Http::asForm()->withHeaders(
            [
                'Authorization' => 'Bearer ' . $accessToken,
            ]
        )->asForm()->post(
            'https://notify-api.line.me/api/notify',
            [
                'message' => '已成功連結'
            ]
        )->json();

        $user = $request->user()->name;
        $token = DB::table('users')->where('name',$user)-> update([
            'line_token' => $accessToken
        ]);

        

        //return redirect(route('profile.linetest'))->with('alert', ' 連動成功！' );
        $groups = Group::get();
        return redirect(route('profile.edit',[
            'user' => $request->user(),
            'all_groups' => $groups,
        ]))->with('alert', ' 連動成功！' );
        //session()->flash('status', '連動完成!');
        //return redirect()->route('supervisor.setting');
    }

    private function getNotifyAccessToken1($username, $code, $redirect_uri) {
        // $admin = Administrator::where(['username'=>$username])->first();


        $apiUrl = "https://notify-bot.line.me/oauth/token";

        $params = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'client_id' => 'Fmqcpg21ohTgNGSU6xo499',
            'client_secret' => 'Ab1AiyJim4QAT1KznrQqZeDPmMY6S4v0eqmYImSRhWu'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        $output = curl_exec($ch);
        curl_close($ch);
        /**
         * {
         *      "status": 200,
         *      "message": "access_token is issued",
         *      "access_token": "7giNDfFWoAO1trYBA34YyfA6IZmazQoF4rmWSqrTtb3"
         *  }
         */
        $result = json_decode($output, true);
        $token = $result['access_token'];
        //\DB::statement("update users set line_notify_token='{$token}' where username='{$username}'");

        $alarm = DB::table('users')->where('name',$username)-> update([
            'line_token' => $token
        ]);




    }

    private function getNotifyAccessToken($username, $code, $redirect_uri) {
        // $admin = Administrator::where(['username'=>$username])->first();

    
        // 獲取 access_token
        $responseData = Http::asForm()->post('https://notify-bot.line.me/oauth/token', [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirect_uri,
            'client_id' => 'Fmqcpg21ohTgNGSU6xo499',
            'client_secret' => 'Ab1AiyJim4QAT1KznrQqZeDPmMY6S4v0eqmYImSRhWu',
        ])->json();

        $accessToken = Arr::get($responseData, 'access_token');

        // 發送 notify 訊息
        $responseData = Http::asForm()->withHeaders(
            [
                'Authorization' => 'Bearer ' . $accessToken,
            ]
        )->asForm()->post(
            'https://notify-api.line.me/api/notify',
            [
                'message' => '你好'
            ]
        )->json();

        $status = Arr::get($responseData, 'status');

        if ($status !== 200) {
            response('連動失敗', $status);
        }

        return response('已經連動成功', 200);

        $token = DB::table('users')->where('name',$username)-> update([
            'line_token' => $accessToken
        ]);


    }


}