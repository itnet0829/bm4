<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_user_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('betting_mode');
            $table->integer('bet_price');
            $table->boolean('money_limit_mode');
            $table->integer('limit_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
