<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_id');
            $table->integer('scorecard_id');
            $table->integer('hole_num');
            $table->integer('par');
            $table->integer('total');
            $table->integer('putt');
            $table->integer('gir')->default(0);
            $table->integer('fairway')->default(0);
            $table->integer('sand')->default(0);
            $table->integer('penalty')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
