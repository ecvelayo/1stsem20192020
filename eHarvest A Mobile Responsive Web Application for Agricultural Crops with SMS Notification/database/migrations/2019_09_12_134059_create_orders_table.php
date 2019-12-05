<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->float('quantity');
            $table->string('order_code');
            $table->enum('status', ['for approval', 'for delivery', 'completed', 'cancelled']);
            $table->string('delivery_place');
            $table->float('delivery_fee');
            $table->date('delivery_date')->nullable();
            $table->float('grand_total');
            $table->datetime('order_datetime');
            $table->enum('obtaining_method', ['delivery', 'pick up']);
            $table->timestamps();

            $table->index('user_id');
            // $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
