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
        Schema::create('listas_de_asistencias', function (Blueprint $table) {
            $table->id();
            $table->string('entidad');
            $table->string('folio');
            $table->dateTime('fecha');
            $table->string('expositor');// <- no esta relacionado con la tabla user porque podria haber expositores externos sin usuario o incluso un curso onlie, en dado caso se debe poner el nombre de la plataforma de cursos online
            $table->string('tema');
            $table->string('path');
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
        Schema::dropIfExists('listas_de_asistencias');
    }
};
