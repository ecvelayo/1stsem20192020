<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_interventions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('interventions');;
            $table->string('interven_name');
            $table->string('descrp');
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
        Schema::dropIfExists('child_interventions');
    }
}
