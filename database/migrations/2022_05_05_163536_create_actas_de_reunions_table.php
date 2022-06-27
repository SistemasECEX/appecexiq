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
        Schema::create('actas_de_reunion', function (Blueprint $table) {
            $table->id();
            $table->string('entidad');
            //$table->string('folio');
            $table->dateTime('fecha');
            $table->string('lugar');
            $table->string('objetivo');
            $table->string('estado');
            $table->string('path')->default('');
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
        Schema::dropIfExists('actas_de_reunion');
    }
};
