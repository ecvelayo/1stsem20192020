<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDismissalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dismissal__records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('d_record_id');
            $table->integer('dismissal_id')->nullable()->unsigned();
            $table->foreign('dismissal_id')->references('id')->on('dismissal__reasons');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->integer('in_department')->unsigned();
            $table->foreign('in_department')->references('id')->on('departments');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('dismissal__records');
    }
}
