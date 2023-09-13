<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Notify;
use App\Models\Group;
use App\Models\Datas;
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
            'T01_6_ph_pre' => 5.2,
            'T01_6_ph_aft' => 6.3,
            'T01_6_ss' => 34.21,
            'T01_12_ph_pre' => 8.1,
            'T01_12_ph_aft' => 7.5,
            'T01_12_drug1_current' => 80,
            'T01_12_drug2_current' => 10,
            'T01_12_drug1_daily'=> 180,
            'T01_12_drug2_daily'=> 50,
            'T01_14_ph'=>7.2,
            'added_on' => '2023-09-25 20:28:48',
        ]);
        
        
        $data->save();

        $model1 = Ai_model::create([
            'model_name' => 'var',
        ]);
        $model2 = Ai_model::create([
            'model_name' => 'lstm',
        ]);
        $model3 = Ai_model::create([
            'model_name' => 'arima',
        ]);
        $model1->save();
        $model2->save();
        $model3->save();

        $pre1 = Prediction::create([
           'added_on' => '2023-09-26 20:30:48',
           'pred_ss' => 207,
           'fk_model_id' => 1,
        ]);

        $pre1->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};