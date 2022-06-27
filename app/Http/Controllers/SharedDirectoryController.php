<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SharedDirectory;
use Illuminate\Support\Facades\Auth;


class SharedDirectoryController extends Controller
{
    //
    public function abrirArchivoCompartido($archivo)
    {
        $archivo = SharedDirectory::where('archivo',$archivo)->first();
        if($archivo)
        {
            return redirect($archivo->url);
        }
        return "No hay archivo";
    }
}
