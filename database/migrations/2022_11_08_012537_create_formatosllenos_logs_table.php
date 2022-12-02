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
        Schema::create('formatosllenos_logs', function (Blueprint $table) {
            $table->id();
            $table->integer("registro_formatollenos_id");
            $table->text("descripcion");
            $table->dateTime("fecha");
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
        Schema::dropIfExists('formatosllenos_logs');
    }
};
