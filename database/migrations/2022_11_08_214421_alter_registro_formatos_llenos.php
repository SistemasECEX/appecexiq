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
        Schema::table('registro_formatosllenos', function ($table) {
            $table->string('nombre_archivo');
            $table->string('ruta');
            $table->dateTime('fecha');
            $table->string('tipo')->boolean()->change();
            $table->renameColumn('tipo', 'anexos');            
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
        Schema::table('registro_formatosllenos', function (Blueprint $table) {
            $table->dropColumn(['nombre_archivo', 'ruta', 'fecha']);              
        });

        Schema::table('registro_formatosllenos', function ($table) {
            $table->boolean('anexos')->string()->change();
            $table->renameColumn('anexos', 'tipo');            
        });       
    }
};
