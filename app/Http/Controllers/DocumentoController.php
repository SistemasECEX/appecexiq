<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where('tipo','Responsable')->orWhere('tipo','Administrador')->get();
        $documentos = Documento::all();
        $nivel = Auth::user()->getUserNivel();
        //$directorios = Storage::allDirectories("public");
        // $directorios = [
        //     "Actas_de_Reunion",
        //     "Perfiles_de_Puesto",
        //     "Formatos_Llenos",
        //     "SGC",
        //     "SGC/Instrucciones",
        //     "SGC/Procedimientos",
        //     "SGC/Seguridad",
        //     "SGC/Calidad",
        // ];
        return view('documentos.documentos', [
            'usuarios' => $usuarios,
            'documentos' => $documentos,
            'nivel' => $nivel
        ]);
    }


    public function getDirectoryArrays($rutas)
    {
        $result = [];
        $count = count($rutas);
        for ($i=$count-1; $i > -1; $i--) 
        { 
            array_push($result,explode("/",$rutas[$i]));
        }
        return $result;
    }

    public function getDirectoryName($path)
    {
        $arr = explode("/",$path);
        return $arr[count($arr)-1];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        $today = Carbon::today();        
        $registro = new Documento;
        
        $registro->codigo = $request->txtCodigo ?? "";
        $registro->titulo = $request->txtTitulo ?? "";
        $registro->rev = "0-0";
        $registro->fecha = $today;
        $registro->responsable_id = $request->txtResponsable;
        $registro->estado = "Completo";
        $registro->activo = 1;
        //dd($registro);
        $registro->save();
        
        return redirect('/documentos/documentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $documento = Documento::find($id);
        return $documento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        $id = $documento->id;
        
        if($documento->delete())
        {
            Storage::deleteDirectory('public/Archivos/Documentos/' . $id);
        }
    }

    public function viewDocumento(Documento $documento)
    {
        $path = 'storage/Archivos/Documentos/' . $documento->id . "/Final/";
        if(file_exists($path))
        {
            $file = scandir($path);
            // tiene que ser mayor de 2 porque los primeros 2 archivos encontrados son = .  y  ..
            if(count($file) > 2)
            {
                return response()->file($path . $file[2]);
            }
        }
        return "No hay archivo";
    }
    public function viewDocumentoMod(Documento $documento)
    {
        $path = 'storage/Archivos/Documentos/' . $documento->id . "/Modificable/";
        if(file_exists($path))
        {
            $file = scandir($path);
                        // tiene que ser mayor de 2 porque los primeros 2 archivos encontrados son = .  y  ..

            if(count($file) > 2)
            {
                return response()->file($path . $file[2]);
            }
        }
        return "No hay archivo";
    }
    public function viewDocumentoWMA(Documento $documento)
    {
        $path = 'storage/Archivos/Documentos/' . $documento->id . "/Marca_de_agua/";
        if(file_exists($path))
        {
            $file = scandir($path);            // tiene que ser mayor de 2 porque los primeros 2 archivos encontrados son = .  y  ..

            if(count($file) > 2)
            {
                return response()->file($path . $file[2]);
            }
        }
        return "No hay archivo";
    }

    public function getDocumentoActivo($codigo)
    {
        $nivel = Auth::user()->getUserNivel();
        $documento = Documento::where('codigo',$codigo)->where('activo',true)->first();
        if($documento && $nivel > 0 && $nivel < 4)
        {
            switch ($nivel) 
            {
                case 1:
                    return $this->viewDocumentoWMA($documento);
                    break;
                case 2:
                    return $this->viewDocumento($documento);
                    break;
                case 3:
                    return $this->viewDocumento($documento);
                    break;
            }
        }
        else
        {
            return "No hay archivo";
        }
    }
}
