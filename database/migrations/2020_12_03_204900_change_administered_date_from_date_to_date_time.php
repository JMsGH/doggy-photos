<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAdministeredDateFromDateToDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administered_dates', function (Blueprint $table) {
            // 日付をdateTimeに変更
            $table->dateTime('administered_date', 6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administered_dates', function (Blueprint $table) {
            $table->date('administered_date')->change();
        });
    }
}
