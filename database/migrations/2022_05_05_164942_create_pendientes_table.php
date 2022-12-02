<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo_de_archivo');
            $table->dateTime('fecha_de_actualizacion');
            $table->string('puntos_urgentes');
            $table->string('estado');
            $table->bigInteger('responsable_id'); // <-relacionado a la tabla usuarios (user_id)
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
        Schema::dropIfExists('pendientes');
    }
};
