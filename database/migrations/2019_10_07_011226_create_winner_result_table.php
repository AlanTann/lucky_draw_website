<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnerResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winner_result', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('grand_winner')->nullable();
            $table->integer('second_first_winner')->nullable();
            $table->integer('second_second_winner')->nullable();
            $table->integer('third_first_winner')->nullable();
            $table->integer('third_second_winner')->nullable();
            $table->integer('third_third_winner')->nullable();
            $table->integer('round')->nullable();
            $table->dateTime('created_date');
            $table->dateTime('updated_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winner_result');
    }
}
