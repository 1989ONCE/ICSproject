<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Notify;
use App\Models\Group;
use App\Models\Datas;
use App\Models\Testdatas;
use App\Models\Ai_model;
use App\Models\Prediction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $notify_1 = Notify::create([
            'method' => '全選',
        ]);
        $notify_2 = Notify::create([
            'method' => 'Email',
        ]);
        $notify_3 = Notify::create([
            'method' => 'LINE',
        ]);
        $notify_1->save();
        $notify_2->save();
        $notify_3->save();

        $group_1 = Group::create([
            'group_name' => '高級主管',
        ]);
        $group_2 = Group::create([
            'group_name' => '主任',
        ]);
        $group_3 = Group::create([
            'group_name' => '技術員',
        ]);
        $group_4 = Group::create([
            'group_name' => '維修人員',
        ]);
        $group_1->save();
        $group_2->save();
        $group_3->save();
        $group_4->save();

        // defualt value only for testing
        $data = Datas::create([
            'T01_2_drug' => 180.4,
            'T01_4_ph' => 1.2,
            'T01_4_drug' => 205.1,
            'T01_5_ph' => 5.3,
            'T01_5_drug1' => 340.45,
            'T01_5_drug2' => 80.67,
            'T01_6_drug' => 36.09,
            'T01_12_ph' => 10.3,
            'T01_12_drug1' => 50.12,
            'T01_12_drug2' => 130.43,
            'T01_13_drug' => 240.12,
            'T01_15_ph' => 7.5,
            'T01_15_temp' => 23.1,
            'T01_15_ec' => 88.32,
            'T01_15_cod' => 102.3,
            'added_on' => '2023-06-26 20:28:48',
        ]);
        $data2 = Datas::create([
            'T01_2_drug' => 180.4,
            'T01_4_ph' => 1.2,
            'T01_4_drug' => 300.1,
            'T01_5_ph' => 5.2,
            'T01_5_drug1' => 330.45,
            'T01_5_drug2' => 75.67,
            'T01_6_drug' => 36.09,
            'T01_12_ph' => 12.3,
            'T01_12_drug1' => 80.12,
            'T01_12_drug2' => 220.43,
            'T01_13_drug' => 240.12,
            'T01_15_ph' => 8.1,
            'T01_15_temp' => 20.1,
            'T01_15_ec' => 89.32,
            'T01_15_cod' => 100.3,
            'added_on' => '2023-06-26 21:28:48',
        ]);
        $data3 = Datas::create([
            'T01_2_drug' => 100.4,
            'T01_4_ph' => 1.4,
            'T01_4_drug' => 274.3,
            'T01_5_ph' => 6.7,
            'T01_5_drug1' => 100.45,
            'T01_5_drug2' => 23.67,
            'T01_6_drug' => 10.09,
            'T01_12_ph' => 8.3,
            'T01_12_drug1' => 10.12,
            'T01_12_drug2' => 50.43,
            'T01_13_drug' => 20.12,
            'T01_15_ph' => 7.3,
            'T01_15_temp' => 19.1,
            'T01_15_ec' => 82.2,
            'T01_15_cod' => 97.3,
            'added_on' => '2023-06-26 22:28:48',
        ]);
        $data4 = Datas::create([
            'T01_2_drug' => 200.4,
            'T01_4_ph' => 3.4,
            'T01_4_drug' => 103.3,
            'T01_5_ph' => 5.7,
            'T01_5_drug1' => 80.45,
            'T01_5_drug2' => 10.67,
            'T01_6_drug' => 7.09,
            'T01_12_ph' => 8.3,
            'T01_12_drug1' => 30.12,
            'T01_12_drug2' => 20.43,
            'T01_13_drug' => 8.12,
            'T01_15_ph' => 7.5,
            'T01_15_temp' => 20.1,
            'T01_15_ec' => 80.2,
            'T01_15_cod' => 96.89,
            'added_on' => '2023-06-26 23:28:48',
        ]);
        $data5 = Datas::create([
            'T01_2_drug' => 150.4,
            'T01_4_ph' => 3.4,
            'T01_4_drug' => 223.3,
            'T01_5_ph' => 4.7,
            'T01_5_drug1' => 191.45,
            'T01_5_drug2' => 80.67,
            'T01_6_drug' => 20.09,
            'T01_12_ph' => 9.3,
            'T01_12_drug1' => 10.12,
            'T01_12_drug2' => 20.43,
            'T01_13_drug' => 3.12,
            'T01_15_ph' => 9.5,
            'T01_15_temp' => 24.1,
            'T01_15_ec' => 105.2,
            'T01_15_cod' => 100.53,
            'added_on' => '2023-06-27 00:28:48',
        ]);
        
        
        $data->save();
        $data2->save();
        $data3->save();
        $data4->save();
        $data5->save();
        
        // defualt value only for testing
        $testdata = Testdatas::create([
            'added_on' => '2023-06-28 11:38:51',
            'data1' => 9.00,
            'data2' => 6.00,
            'data3' => 88.00,
            'data4' => 122.00,
            'data5' => 5.00,
            'data6' => 7.00,
            'data7' => 4.00,
            'data8' => 21.00,
            'data9' => 7.00,
            'data10' => 22.00,
        ]);
        $testdata->save();

        $model1 = Ai_model::create([
            'model_name' => 'arima',
        ]);
        $model2 = Ai_model::create([
            'model_name' => 'var',
        ]);
        $model3 = Ai_model::create([
            'model_name' => 'lstm',
        ]);
        $model4 = Ai_model::create([
            'model_name' => 'bpann',
        ]);
        $model5 = Ai_model::create([
            'model_name' => 'gru',
        ]);
        $model6 = Ai_model::create([
            'model_name' => 'excel',
        ]);
        $model1->save();
        $model2->save();
        $model3->save();
        $model4->save();
        $model5->save();
        $model6->save();

        $pre1 = Prediction::create([
           'added_on' => '2023-06-28 11:38:51',
           'T01_2_pre_drug' => 9,
           'T01_4_pre_drug' => 6,
           'T01_5_pre_drug1' => 100,
           'T01_5_pre_drug2' => 114,
           'T01_6_pre_drug' => 4,
           'T01_12_pre_drug1' => 8,
           'T01_12_pre_drug2' => 4,
           'T01_13_pre_drug' => 22,
            'fk_model_id' => 1,
        ]);
        $pre2 = Prediction::create([
            'added_on' => '2023-06-28 11:38:51',
            'T01_2_pre_drug' => 3,
            'T01_4_pre_drug' => 1,
            'T01_5_pre_drug1' => 90,
            'T01_5_pre_drug2' => 115,
            'T01_6_pre_drug' => 3,
            'T01_12_pre_drug1' => 9,
            'T01_12_pre_drug2' => 6,
            'T01_13_pre_drug' => 23,
             'fk_model_id' => 2,
         ]);
         $pre3 = Prediction::create([
            'added_on' => '2023-06-28 11:38:51',
            'T01_2_pre_drug' => 10,
            'T01_4_pre_drug' => 26,
            'T01_5_pre_drug1' => 110,
            'T01_5_pre_drug2' => 124,
            'T01_6_pre_drug' => 7,
            'T01_12_pre_drug1' => 4,
            'T01_12_pre_drug2' => 8,
            'T01_13_pre_drug' => 19,
             'fk_model_id' => 3,
         ]);
         $pre4 = Prediction::create([
            'added_on' => '2023-06-28 11:38:51',
            'T01_2_pre_drug' => 3,
            'T01_4_pre_drug' => 1,
            'T01_5_pre_drug1' => 50,
            'T01_5_pre_drug2' => 134,
            'T01_6_pre_drug' => 7,
            'T01_12_pre_drug1' => 9,
            'T01_12_pre_drug2' => 10,
            'T01_13_pre_drug' => 21,
             'fk_model_id' => 4,
         ]);
         $pre5 = Prediction::create([
            'added_on' => '2023-06-28 11:38:51',
            'T01_2_pre_drug' => 9.1,
            'T01_4_pre_drug' => 7,
            'T01_5_pre_drug1' => 131,
            'T01_5_pre_drug2' => 111.3,
            'T01_6_pre_drug' => 4.9,
            'T01_12_pre_drug1' => 8.1,
            'T01_12_pre_drug2' => 4,
            'T01_13_pre_drug' => 22.2,
             'fk_model_id' => 5,
         ]);
         $pre6 = Prediction::create([
            'added_on' => '2023-06-28 11:38:51',
            'T01_2_pre_drug' => 9,
            'T01_4_pre_drug' => 6,
            'T01_5_pre_drug1' => 100,
            'T01_5_pre_drug2' => 118,
            'T01_6_pre_drug' => 8,
            'T01_12_pre_drug1' => 7,
            'T01_12_pre_drug2' => 8,
            'T01_13_pre_drug' => 20.5,
             'fk_model_id' => 6,
         ]);
        $pre1->save();
        $pre2->save();
        $pre3->save();
        $pre4->save();
        $pre5->save();
        $pre6->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};