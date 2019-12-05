<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLineItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_line_item', function (Blueprint $table) {
            $table->increments('order_line_id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('order');
            $table->integer('meal_id')->unsigned();
            $table->foreign('meal_id')->references('meal_id')->on('meal');
            $table->integer('status');
            $table->date('date_redeemed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_line_item');
    }
}

