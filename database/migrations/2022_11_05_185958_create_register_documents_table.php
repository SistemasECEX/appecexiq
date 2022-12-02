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
        Schema::create('register_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('doc_id'); // doc_id
            $table->string('nombre_archivo');
            $table->string('revision');
            $table->dateTime('fecha');
            $table->string('ruta');
            $table->boolean('activo')->default(1);
            $table->string('tipo');
            $table->boolean('estatus')->default(1);
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
        Schema::dropIfExists('register_documents');
    }
};
