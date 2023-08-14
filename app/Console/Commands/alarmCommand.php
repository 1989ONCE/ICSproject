<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

use App\Notifications\Warning;

use App\Models\Alarm;

use App\Models\agjoin;

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class alarmCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarm_send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $warningData = [
            'body' => 'You received an new warning notification',
            'text' => 'There is something wrong',
            'url' => url('http://localhost/ICSproject/public/realtime'),
            'thankyou' => 'Go to check out'
        ];
        
        $data1 =  DB::table('testdatas')->latest('added_on')->value('data1');
        $data2 =  DB::table('testdatas')->latest('added_on')->value('data2');
        $data3 =  DB::table('testdatas')->latest('added_on')->value('data3');
        $data4 =  DB::table('testdatas')->latest('added_on')->value('data4');
        $data5 =  DB::table('testdatas')->latest('added_on')->value('data5');
        $data6 =  DB::table('testdatas')->latest('added_on')->value('data6');
        $data7 =  DB::table('testdatas')->latest('added_on')->value('data7');

        $check_type = array("冷卻塔_ph值","快混槽1_ph值","快混槽2_ph值","放流槽_ph值","放流槽_水溫","放流槽_導電度","放流槽_COD");
        $datas = array($data1,$data2,$data3,$data4,$data5,$data6,$data7); 

        for($k = 0; $k < 6; $k++){
            //info($data1) ;
            $operators1 = Alarm::where('alarm_type',$check_type[$k])->pluck('operator')->toArray();
            $numbers1 = Alarm::where('alarm_type',$check_type[$k])->pluck('alarm_num')->toArray();
            $ids1 = Alarm::where('alarm_type',$check_type[$k])->pluck('alarm_id')->toArray();
            //$count = $ids1->count();
            for ($i = 0 ; $i < count($ids1); $i++){
                switch($operators1[$i]){
                    case ">":
                        if($datas[$k] > $numbers1[$i]){
                            $users = agjoin::where('fk_alarm_id',$ids1[$i])->pluck('fk_user_id')->toArray();
                            $groups = agjoin::where('fk_alarm_id',$ids1[$i])->pluck('fk_group_id')->toArray();
                            //$emails = User::whereIn('id',$users)->get(); //toArray();

                            $emails = User::whereIn('id',$users)->orWhereIn('fk_group_id',$groups)->get(); //只有取user非email
                            Notification::send($emails,new Warning($warningData));
                            //$this->call('line:notification');

                            $token = User::whereIn('id',$users)->orWhereIn('fk_group_id',$groups)->pluck('line_token')->toArray();
                            for ($i = 0 ; $i < count($token); $i++){
                                $responseData = Http::asForm()->withHeaders(
                                    [
                                        'Authorization' => 'Bearer ' . $token[$i],
                                    ]
                                )->asForm()->post(
                                    'https://notify-api.line.me/api/notify',
                                    [
                                        'message' => '告警通知'
                                    ]
                                )->json();
                            }


                        }
                        break;
                    case "=":
                        if($datas[$k] == $numbers1[$i]){
                            $users = agjoin::where('fk_alarm_id',$ids1[$i])->pluck('fk_user_id')->toArray();
                            $groups = agjoin::where('fk_alarm_id',$ids1[$i])->pluck('fk_group_id')->toArray();
                            //$emails = User::whereIn('id',$users)->get(); //toArray();
                            
                            $emails = User::whereIn('id',$users)->orWhereIn('fk_group_id',$groups)->get();
                            Notification::send($emails,new Warning($warningData));
                            //$this->call('line:notification');

                            $token = User::whereIn('id',$users)->orWhereIn('fk_group_id',$groups)->pluck('line_token')->toArray();
                            for ($i = 0 ; $i < count($token); $i++){
                                $responseData = Http::asForm()->withHeaders(
                                    [
                                        'Authorization' => 'Bearer ' . $token[$i],
                                    ]
                                )->asForm()->post(
                                    'https://notify-api.line.me/api/notify',
                                    [
                                        'message' => '告警通知'
                                    ]
                                )->json();
                            }

                        }
                        break;
                    case "<":
                        if($datas[$k] < $numbers1[$i]){
                            $users = agjoin::where('fk_alarm_id',$ids1[$i])->pluck('fk_user_id')->toArray();
                            $groups = agjoin::where('fk_alarm_id',$ids1[$i])->pluck('fk_group_id')->toArray();
                            //$emails = User::whereIn('id',$users)->get(); //toArray();
                            
                            $emails = User::whereIn('id',$users)->orWhereIn('fk_group_id',$groups)->get();
                            Notification::send($emails,new Warning($warningData));
                            //$this->call('line:notification');

                            $token = User::whereIn('id',$users)->orWhereIn('fk_group_id',$groups)->pluck('line_token')->toArray();
                            for ($i = 0 ; $i < count($token); $i++){
                                $responseData = Http::asForm()->withHeaders(
                                    [
                                        'Authorization' => 'Bearer ' . $token[$i],
                                    ]
                                )->asForm()->post(
                                    'https://notify-api.line.me/api/notify',
                                    [
                                        'message' => '告警通知'
                                    ]
                                )->json();
                            }
                        }
                        break;
                }
            }
        }
/*
        foreach($operators1 as $operator1,$numbers1 as $number1,$ids1 as $id1){
            switch($operator1){
                case '>':
                    if($data1 > $number1){
                        $users = DB::table('ag_joins')->where('alarm_id',$id1)->toArray();
                        $emails = DB::table('users')->whereIn('id',$users)->get(); //toArray();

                        foreach($emails as $email){
                            $email->notify(new Warning($warningData));
                        }
                    }
                    break;
                case '=':
                    if($data1 == $number1){
                        send;
                    }
                    break;
                case '<':
                    if($data1 < $number1){
                        send;
                    }
                    break;
            }
        }
*/
        


        

    }
}
