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
            $table->increments('id');
            $table->string('cedula')->unique()->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('telefono')->nullable();
            $table->string('genero');
            $table->string('nacionalidad')->nullable();
            $table->string('picture')->default('man.png');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('facebook_id')->nullable();
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
        Schema::drop('users');
    }
}
