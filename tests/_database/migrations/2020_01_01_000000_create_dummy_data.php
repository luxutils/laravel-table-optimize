<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDummyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table1', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data');
        });
        Schema::create('table2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('table1');
        Schema::drop('table2');
    }
}
