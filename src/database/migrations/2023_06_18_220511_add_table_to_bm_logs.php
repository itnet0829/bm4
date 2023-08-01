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
        Schema::create('bm_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->integer('user_id');
            $table->boolean('format');
            $table->string('img_file');
            $table->longText('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bm_logs', function (Blueprint $table) {
            //
        });
    }
};
