<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangebackAdministeredDateType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administered_dates', function (Blueprint $table) {
            // 日付をdateに変更
            $table->date('administered_date')->change();
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
            $table->dateTime('administered_date', 6)->change();
        });
    }
}
