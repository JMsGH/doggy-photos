<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDefaultForCounterOnFilariasisMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filariasis_medications', function (Blueprint $table) {
            // counterのデフォルト値を 0 に設定
             $table->unsignedSmallInteger('counter')->default(0)->change();
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
            $table->unsignedSmallInteger('counter')->change();
        });
    }
}
