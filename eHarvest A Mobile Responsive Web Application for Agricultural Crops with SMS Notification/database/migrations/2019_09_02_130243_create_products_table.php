<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('product_name');
            $table->unsignedInteger('types_id');
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
            $table->text('product_description');
            $table->float('quantity');
            $table->float('price')->nullable();
            $table->float('srp');
            $table->float('markup');
            $table->unsignedInteger('units_id');
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
