<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('cedula')->unique();;
            $table->string('nombre');         
            $table->string('email')->unique();
            $table->bigInteger('celular');
            $table->integer('codigo_ciudad');
            $table->date('fecha_nacimiento');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('password_verified')->nullable();
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