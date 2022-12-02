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
        Schema::create('registro_formatosllenos', function (Blueprint $table) {
            $table->id();
            $table->integer("formato_llenos_id");
            $table->string("tipo");//Documento, Evidencia o Anexo.
            $table->text("descripcion");
            $table->boolean("status")->default(1);
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
        Schema::dropIfExists('registro_formatosllenos');
    }
};
