<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('skills')->nullable();
            $table->smallInteger('step')->default(0);
            $table->boolean('isFinal')->default(false);
            $table->smallInteger('duration');
            $table->smallInteger('completion');
            $table->boolean('archived')->default(false);
            $table->unsignedBigInteger('suggested_training_id')->nullable();
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
        Schema::dropIfExists('trainings');
    }
}
