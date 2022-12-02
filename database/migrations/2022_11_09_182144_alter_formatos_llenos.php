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
        //
        Schema::table('formatos_llenos', function (Blueprint $table) {
            $table->string('periodo'); //diario, semanal, mensual, anual, eventual
            $table->date('fecha_inicial')->default(now());
            $table->date('fecha_siguiente')->default(now());
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('formatos_llenos', function (Blueprint $table) {
            $table->dropColumn(['periodo', 'fecha_inicial', 'fecha_siguiente']);
        });
    }
};
