<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Registro_formatosllenos;
use App\Http\Requests\StoreRegistro_formatosllenosRequest;
use App\Http\Requests\UpdateRegistro_formatosllenosRequest;

use App\Models\FormatoLleno;
use App\Models\formatos_llenos_anexos;
use App\Models\register_document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegistroFormatosllenosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreRegistro_formatosllenosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requestdoc)
    {
        //
        $year = Carbon::now()->year; // 2022        

        $fechahoy=Carbon::now()->year."-".Carbon::now()->month."-".Carbon::now()->day;
        $today = Carbon::today();

        $objaguardar=new Registro_formatosllenos;          
        
        
        $idregfll=FormatoLleno::where('codigo',$requestdoc->txtCodigo)->first();        
        $objaguardar->formato_llenos_id=$idregfll->id;
        
        $objaguardar->descripcion=$requestdoc->descripcion;
        $objaguardar->status=1;
        $objaguardar->nombre_archivo=$_FILES['file']['name'];
        $objaguardar->fecha=$today;
        $auxdir='Formatos_llenos\\' . $requestdoc->txtCodigo . '\\'.$year.'\\'.$fechahoy.'\\';
        $dir =  $auxdir.$_FILES['file']['name']; // . $requestdoc->file('file')->extension();
        $path = 'public\\' . $dir;
        if(file_exists($path))
        {
            // si ya hay un archivo con el mismo nombre se va a remplazar
            Storage::deleteDirectory($dir);
        }
        Storage::put($path, file_get_contents($requestdoc->file('file')));
        $objaguardar->ruta=$dir ?? "";
        if($requestdoc->file('evidencias') !== null) 
        {
            $objaguardar->anexos="Si";
            $objaguardar->save();
            $x=0;
           
            foreach ($requestdoc->file('evidencias') as $file) 
            {
                $anexos=new formatos_llenos_anexos;
                $x++;
                $anexos->registro_formatos_llenos_id=$objaguardar->id;
                $auxpath=$auxdir. 'anexos\\anexo-' . $x .'.'. $file->extension();
                $path_adjuntos_public = 'public\\'. $auxpath;
                Storage::put($path_adjuntos_public, file_get_contents($file));
                $anexos->nombre_archivo='anexo-'.$x.'.'.$file->extension();
                $anexos->ruta=$auxpath;
                $anexos->status=1;
                $anexos->save();
            }
        }
        else
        {
            $objaguardar->anexos="No";
            $objaguardar->save();
        }
        return redirect('/documentos/formatos_llenos');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro_formatosllenos  $registro_formatosllenos
     * @return \Illuminate\Http\Response
     */
    public function show(string $codigo)
    {
        //        
        $listado=Registro_formatosllenos::all();

        return view ('documentos.fll_codigo',[
            'registros_llenos'=>$listado,
            'cod_selec'=>$codigo,            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro_formatosllenos  $registro_formatosllenos
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro_formatosllenos $registro_formatosllenos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistro_formatosllenosRequest  $request
     * @param  \App\Models\Registro_formatosllenos  $registro_formatosllenos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistro_formatosllenosRequest $request, Registro_formatosllenos $registro_formatosllenos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro_formatosllenos  $registro_formatosllenos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro_formatosllenos $registro_formatosllenos)
    {
        //
    }

    public function nuevoregistro(string $codigo)
    {
        //        
       return view('documentos.fll.nuevoreg',[
                'codigo'=>$codigo
        ]);
    }

    public function viewFormatoLleno(string $formato)
    {
        /*$path_archivo_storage = 'storage/Archivos/Formatos_Llenos/' . $formato->id . '/' . $formato->id . ".pdf";

        if(file_exists($path_archivo_storage))
        {
            return response()->file($path_archivo_storage);
        }*/
        $inforuta=Registro_formatosllenos::where('id',$formato)->first();
        $path='storage/'.$inforuta->ruta;
        //dd($path);
        if(file_exists($path))
        {
            return response()->file($path);
        }
        return "No hay archivo";
    }

    public function viewanexos(string $idanexo)
    {
        //
        $ObjAnexos=formatos_llenos_anexos::where('registro_formatos_llenos_id',$idanexo)->get();
        //dd($ObjAnexos);
        return $ObjAnexos;
    }

    public function viewidanexo(string $formato)
    {        
        $inforuta=formatos_llenos_anexos::where('id',$formato)->first();        
        $path='storage/'.$inforuta->ruta;
        //dd($path);
        if(file_exists($path))
        {
            return response()->file($path);
        }
        return "No hay archivo";
    }
}
