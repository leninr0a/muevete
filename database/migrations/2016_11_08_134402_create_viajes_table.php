<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('salida'); //Lugar de salida
            $table->string('salidaLat');
            $table->string('salidaLng');
            $table->string('llegada'); //Lugar de llegada
            $table->string('llegadaLat');
            $table->string('llegadaLng');
            $table->date('fecha');
            $table->string('hora');
            $table->decimal('precio');
            $table->integer('asientos');
            $table->integer('asientos_reservados')->default(0);
            $table->text('informacion');
            $table->boolean('efectivo');
            $table->boolean('pago_online');
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
        Schema::dropIfExists('viajes');
    }
}
