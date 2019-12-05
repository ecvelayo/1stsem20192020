<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_history', function (Blueprint $table) {
            $table->increments('credit_history_id');
            $table->integer('no_of_passenger');
            $table->float('points_earned', 8, 2);
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('employee_id')->on('employee');
            $table->integer('patron_id')->unsigned();
            $table->foreign('patron_id')->references('patron_id')->on('patron');
            $table->date('date_earned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_history');
    }
}
