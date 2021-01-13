<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangebackFilariasisMedicationsDateType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filariasis_medications', function (Blueprint $table) {
            // 日付をdateに変更
            $table->date('start_date')->change();
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
            $table->dateTime('start_date', 6)->change();
        });
    }
}
