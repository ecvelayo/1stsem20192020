<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('contact');
            $table->string('address');
            $table->date('birthdate');
            $table->enum('type', ['Consumer', 'Admin', 'Farmer', 'Driver']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('photo');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
