<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class FormatoLleno extends Model
{
    use HasFactory;
    protected $table = 'formatos_llenos';

    public function getAdjuntos()
    {
        $path_adjuntos = 'public/Archivos/Formatos_Llenos/' . $this->id . '/adjuntos/';
        $adjuntos = Storage::allFiles($path_adjuntos);
        $ret = [];
        foreach ($adjuntos as $adjunto) 
        {
            array_push($ret, str_replace("public/","storage/",$adjunto));
        }
        return $ret;

    }
}
