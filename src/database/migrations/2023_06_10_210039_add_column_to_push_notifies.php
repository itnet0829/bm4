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
        Schema::table('push_notifies', function (Blueprint $table) {
            $table->integer('group_id')->nullable()->after('user_id');
            $table->timestamp('start_broadcasting_time')->after('all_pushing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('push_notifies', function (Blueprint $table) {
            //
        });
    }
};
