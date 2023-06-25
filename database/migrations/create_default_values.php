<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Notify;
use App\Models\Group;
use App\Models\Pool;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $notify_1 = Notify::create([
            'method' => 'Email',
        ]);
        $notify_2 = Notify::create([
            'method' => 'LINE',
        ]);
        $notify_1->save();
        $notify_2->save();

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

        $pool_1 = Pool::create([
            'pool_num' => 'T01-2',
            'pool_name' => 'pH中和槽',
        ]);
        $pool_2 = Pool::create([
            'pool_num' => 'T01-4',
            'pool_name' => '冷卻塔',
        ]);
        $pool_3 = Pool::create([
            'pool_num' => 'T01-5',
            'pool_name' => '快混槽1',
        ]);
        $pool_4 = Pool::create([
            'pool_num' => 'T01-6',
            'pool_name' => '慢混槽1',
        ]);
        $pool_5 = Pool::create([
            'pool_num' => 'T01-12',
            'pool_name' => '快混槽2',
        ]);
        $pool_6 = Pool::create([
            'pool_num' => 'T01-13',
            'pool_name' => '慢混槽2',
        ]);
        $pool_7 = Pool::create([
            'pool_num' => 'T01-15',
            'pool_name' => '放流槽',
        ]);
        $pool_1->save();
        $pool_2->save();
        $pool_3->save();
        $pool_4->save();
        $pool_5->save();
        $pool_6->save();
        $pool_7->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};