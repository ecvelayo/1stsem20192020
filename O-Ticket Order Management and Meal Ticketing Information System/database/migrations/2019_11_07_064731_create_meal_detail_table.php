<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_detail', function (Blueprint $table) {
            $table->increments('meal_detail_id');
            $table->integer('meal_id')->unsigned();
            $table->foreign('meal_id')->references('meal_id')->on('meal');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('item_id')->on('item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_detail', function (Blueprint $table) {
            //
        });
    }
}
