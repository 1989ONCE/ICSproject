<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('powers', function (Blueprint $table) {
            $table->id('power_id');
            $table->boolean('status');
            $table->timestamp('onofftime');
        });
        Schema::create('ai_models', function (Blueprint $table) {
            $table->id('model_id');
            $table->string('model_name');
            $table->string('model_loc')->nullable();
            $table->double('accuracy')->nullable();
        });
        Schema::create('notifies', function (Blueprint $table) {
            $table->id('notify_id');
            $table->string('method');
        });
        Schema::create('datas', function (Blueprint $table) {
            $table->id('data_id');
            $table->double('T01_2_drug', 6, 2);
            $table->double('T01_4_ph', 6, 2);
            $table->double('T01_4_drug', 6, 2);
            $table->double('T01_5_ph', 6, 2);
            $table->double('T01_5_drug1', 6, 2);
            $table->double('T01_5_drug2', 6, 2);
            $table->double('T01_6_drug', 6, 2);
            $table->double('T01_12_ph', 6, 2);
            $table->double('T01_12_drug1', 6, 2);
            $table->double('T01_12_drug2', 6, 2);
            $table->double('T01_13_drug', 6, 2);
            $table->double('T01_15_ph', 6, 2);
            $table->double('T01_15_temp', 6, 2);
            $table->double('T01_15_ec', 6, 2);
            $table->double('T01_15_cod', 6, 2);
            $table->timestamp('added_on');
        });
       
        Schema::create('alarms', function (Blueprint $table) {
            $table->id('alarm_id');
            $table->string('alarm_name');
            $table->string('alarm_type');
            $table->char('operator', 1);
            $table->double('alarm_num', 10, 3);
            $table->bigInteger('fk_notify_id')->unsigned();
            $table->foreign('fk_notify_id')
                ->references('notify_id')
                ->on('notifies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::create('predictions', function (Blueprint $table) {
            $table->id('predict_id');
            $table->double('T01_2_pre_drug', 6, 2);
            $table->double('T01_4_pre_drug', 6, 2);
            $table->double('T01_5_pre_drug1', 6, 2);
            $table->double('T01_5_pre_drug2', 6, 2);
            $table->double('T01_6_pre_drug', 6, 2);
            $table->double('T01_12_pre_drug1', 6, 2);
            $table->double('T01_12_pre_drug2', 6, 2);
            $table->double('T01_13_pre_drug', 6, 2);
            $table->timestamp('added_on');
            $table->bigInteger('fk_model_id')->unsigned();
            $table->foreign('fk_model_id')
                ->references('model_id')
                ->on('ai_models')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::create('groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name');
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('Badge_num')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->string('line_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('fk_group_id')->unsigned();
            $table->foreign('fk_group_id')
                 ->references('group_id')
                 ->on('groups')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('ag_joins', function (Blueprint $table) {
            $table->id('ag_join_id');
            $table->string('ag_join_name');
            $table->bigInteger('fk_alarm_id')->unsigned();
            $table->foreign('fk_alarm_id')
                 ->references('alarm_id')
                 ->on('alarms')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');
            $table->bigInteger('fk_group_id')->unsigned()->nullable();
            $table->foreign('fk_group_id')
                ->references('group_id')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('fk_user_id')->unsigned()->nullable();
            $table->foreign('fk_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};