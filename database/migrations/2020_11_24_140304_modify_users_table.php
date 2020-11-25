<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            // about_me_and_dog と photo カラムにNULLを許容
            $table->text('about_me_and_dog')->nullable()->change();
            $table->text('photo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            // about_me_and_dog と photo カラムにNULLを許容しない
            $table->text('about_me_and_dog')->nullable(false)->change();
            $table->text('photo')->nullable(false)->change();
        });
    }
}
