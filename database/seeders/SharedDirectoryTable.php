<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SharedDirectoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shared_directories')->insert(['archivo' => 'Matriz_de_Riesgos','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwkxAGa0-3YHtQhHH?e=lVWfYb']);
        DB::table('shared_directories')->insert(['archivo' => 'Encuestas_de_satisfaccion_al_cliente','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwlCTmLihajO7JIMT?e=zhHmbH']);
        DB::table('shared_directories')->insert(['archivo' => 'Matriz_de_Capactaciones','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwk13VKZ9WCIMkzlN?e=wy2lKG']);
        DB::table('shared_directories')->insert(['archivo' => 'Lista_de_Proveedores','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwlfl5UOi7wS2zI8f?e=B52vK4']);
        DB::table('shared_directories')->insert(['archivo' => 'Evaluacion_de_Proveedores','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwk4rjuzNOW9CSVcs?e=r5OkWZ']);
        DB::table('shared_directories')->insert(['archivo' => 'Matriz_de_Salidas_no_Conformes','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwk9zyGivvXth-b_3?e=AGDYZx']);
        DB::table('shared_directories')->insert(['archivo' => 'Listado_de_Acciones','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwlFUVA2VwjNJL5kE?e=qYOoLm']);
        DB::table('shared_directories')->insert(['archivo' => 'AC_Pendientes','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwlhzb9yl4zh85QoB?e=0e2paV']);
        DB::table('shared_directories')->insert(['archivo' => 'Lista_de_Pendientes','url' => 'https://1drv.ms/u/s!An6sBsLo8MjDwlmQXaiOmt0B-SuJ?e=IRi1B9']);
    }
}
