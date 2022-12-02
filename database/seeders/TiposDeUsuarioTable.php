<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDeUsuarioTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipos_de_usuario')->insert(['tipo' => 'Administrador','permisos' => 'all']);
        DB::table('tipos_de_usuario')->insert(['tipo' => 'Responsable','permisos' => 'read write']);
        DB::table('tipos_de_usuario')->insert(['tipo' => 'Regular','permisos' => 'read']);
    }
}
