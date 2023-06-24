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
        Schema::create('ai_models', function (Blueprint $table) {
            $table->id('model_id');
            $table->string('model_name');
        });
        Schema::create('notifys', function (Blueprint $table) {
            $table->id('notify_id');
            $table->string('method');
        });
        Schema::create('pools', function (Blueprint $table) {
            $table->id('pool_id');
            $table->string('pool_name');
        });
        Schema::create('datas', function (Blueprint $table) {
            $table->id('data_id');
            $table->integer('ph');
            $table->double('temp', 6, 2);
            $table->double('EC', 6, 2);
            $table->double('COD', 6, 2);
            $table->double('SS', 6, 2);
            $table->timestamp('added_on');
            $table->bigInteger('fk_pool_id')->unsigned();
            $table->foreign('fk_pool_id')
                ->references('pool_id')
                ->on('pools')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::create('testdatas', function (Blueprint $table) {
            $table->id('testdata_id');
            $table->timestamp('added_on');
            $table->double('data1', 6, 2);
            $table->double('data2', 6, 2);
            $table->double('data3', 6, 2);
            $table->double('data4', 6, 2);
            $table->double('data5', 6, 2);
            $table->double('data6', 6, 2);
            $table->double('data7', 6, 2);
            $table->double('data8', 6, 2);
            $table->double('data9', 6, 2);
            $table->double('data10', 6, 2);
        });
        Schema::create('alarms', function (Blueprint $table) {
            $table->id('alarm_id');
            $table->string('alarm_name');
            $table->char('operator', 1);
            $table->bigInteger('fk_notify_id')->unsigned();
            $table->foreign('fk_notify_id')
                ->references('notify_id')
                ->on('notifys')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::create('predictions', function (Blueprint $table) {
            $table->id('predict_id');
            $table->string('value');
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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
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
            $table->bigInteger('fk_group_id')->unsigned();
            $table->foreign('fk_group_id')
                ->references('group_id')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('fk_user_id')->unsigned();
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