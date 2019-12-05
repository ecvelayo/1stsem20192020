<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolledTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('training_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('is_completed')->default(false);
            $table->text('current')->nullable();
            $table->float('progress', 5, 2)->unsigned()->default(0);
            $table->timestamp('date_completed')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolled_trainings');
    }
}
