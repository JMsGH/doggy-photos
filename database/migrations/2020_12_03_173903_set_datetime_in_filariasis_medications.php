<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDatetimeInFilariasisMedications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filariasis_medications', function (Blueprint $table) {
            // 日付をdateTimeに変更
            $table->dateTime('start_date', 6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filariasis_medications', function (Blueprint $table) {
            $table->date('start_date')->change();
        });
    }
}
