<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatronTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patron', function (Blueprint $table) {
            $table->integer('patron_id')->unsigned();
            $table->foreign('patron_id')->references('user_id')->on('users');
            $table->string('phone_number', 10)->unique();
            $table->boolean('patron_type');
            $table->date('last_redeemed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patron');
    }
}
