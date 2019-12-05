<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faileds', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger('user_tests_id')->unsigned();
            // $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('enrolled_trainings_id')->unsigned();
            $table->timestamps();

            // $table->foreign('user_tests_id')->references('id')->on('user_tests')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('enrolled_trainings_id')->references('id')->on('enrolled_trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faileds');
    }
}
