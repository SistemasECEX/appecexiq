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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('titulo');
            $table->string('rev');
            $table->dateTime('fecha');
            $table->bigInteger('responsable_id'); // <-relacionado a la tabla usuarios (user_id)
            $table->string('path')->default('');
            $table->string('path_modificable')->default('');
            $table->string('path_marca_de_agua')->default('');
            $table->string('estado');
            $table->boolean('activo');
            // $table->string('nivel_requerido');
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
        Schema::dropIfExists('documentos');
    }
};
