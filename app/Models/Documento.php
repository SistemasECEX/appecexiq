<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Documento extends Model
{
    use HasFactory;

    public function responsable()
    {
        return User::find($this->responsable_id);
    }
    public function path()
    {
        $path = 'storage/Archivos/Documentos/' . $this->id . "/Final/";
        if(file_exists($path))
        {
            $file = scandir($path);
            //para considerar que el registro cuenta con un solo archivo dentro de la carpeta 
            //se pide que el arreglo de archivos dentro sea de 3 elementos porque los primeros 2 son "." y ".."
            if(count($file) == 3)
            {
                return true;
            }
        }
        return false;
    }
    public function path_modificable()
    {
        $path = 'storage/Archivos/Documentos/' . $this->id . "/Modificable/";
        if(file_exists($path))
        {
            $file = scandir($path);
            if(count($file) == 3)
            {
                return true;
            }
        }
        return false;
    }
    public function path_marca_de_agua()
    {
        $path = 'storage/Archivos/Documentos/' . $this->id . "/Marca_de_agua/";
        if(file_exists($path))
        {
            $file = scandir($path);
            if(count($file) == 3)
            {
                return true;
            }
        }
        return false;
    }
}

