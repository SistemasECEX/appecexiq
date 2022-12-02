<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerilesDePuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('perfiles_de_puesto')->insert(['codigo' => 'AA-BB-CC-00','nombre' => 'JEFE','rev' => '1.0','fecha' => '2022-06-03 00:00:00','path' => 'public/Archivos/Perfiles_de_Puesto/123456.pdf',]);
        DB::table('perfiles_de_puesto')->insert(['codigo' => 'AA-BB-CC-01','nombre' => 'Gerente de Operaciones','rev' => '1.1','fecha' => '2022-06-03 00:00:00','path' => 'public/Archivos/Perfiles_de_Puesto/123456.pdf',]);
        DB::table('perfiles_de_puesto')->insert(['codigo' => 'AA-BB-CC-02','nombre' => 'Montacarguista','rev' => '1.2','fecha' => '2022-06-03 00:00:00','path' => 'public/Archivos/Perfiles_de_Puesto/123456.pdf',]);
        DB::table('perfiles_de_puesto')->insert(['codigo' => 'AA-BB-CC-03','nombre' => 'Empleado General','rev' => '2.0','fecha' => '2022-06-03 00:00:00','path' => 'public/Archivos/Perfiles_de_Puesto/123456.pdf',]);
        DB::table('perfiles_de_puesto')->insert(['codigo' => 'AA-BB-CC-04','nombre' => 'Supervisor','rev' => '2.0','fecha' => '2022-06-03 00:00:00','path' => 'public/Archivos/Perfiles_de_Puesto/123456.pdf',]);
    }
}
