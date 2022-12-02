<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\register_document;
use App\Http\Requests\Storeregister_documentRequest;
use App\Http\Requests\Updateregister_documentRequest;
use App\Models\Documento;
use League\CommonMark\Node\Block\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;

class RegisterDocumentController extends Controller
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
     * @param  \App\Http\Requests\Storeregister_documentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $docureg=Documento::find($request->txtCodigo);
        for($i = 1;$i<=2;$i++)
        {
            $registro = new register_document;
            //$registro->codigo = $request->txtCodigo ?? "";
            $registro->doc_id=$request->txtCodigo;
            $registro->nombre_archivo = $request->txtTitulo;
            $registro->revision = $request->txtRev ?? "";
            $registro->fecha = $request->txtFecha;
            $path="";
            if($i==1)
            {
                if($_FILES['file']['name'] != "") 
                {
                    $version = $request->txtRev;
                    $dir = 'Documentos\\' . $request->txtCodEleg . '\\2022\\' .$version. '\\' . $request->txtTitulo . '_Final.' . $request->file('file')->extension();;
                    //$dir_storage = 'storage/Archivos/Documentos/' . $registro->id . '/' . $version;
                    $path = 'public\\' . $dir;

                    if(file_exists($path))
                    {
                    // si ya hay un archivo con el mismo nombre se va a remplazar
                        Storage::deleteDirectory($dir);
                    }
                    Storage::put($path, file_get_contents($request->file('file')));
                }   
                $registro->ruta=$dir ?? "";
                $registro->tipo="FINAL";
            }
            else
            {
                if($_FILES['fileSource']['name'] != "") 
                {
                    $version = $request->txtRev;
                    $dir = 'Documentos\\' . $request->txtCodEleg . '\\2022\\' .$version. '\\' . $request->txtTitulo . '_Editable.' . $request->file('fileSource')->extension();;
                    //$dir_storage = 'storage/Archivos/Documentos/' . $registro->id . '/' . $version;
                    $path ='public\\' . $dir;                    
                    if(file_exists($path))
                    {
                        // si ya hay un archivo con el mismo nombre se va a remplazar
                        Storage::deleteDirectory($dir);
                    }   
                    Storage::put($path, file_get_contents($request->file('fileSource')));
                }
                $registro->ruta=$dir;
                $registro->tipo="EDITABLE";
            }
            $registro->estatus=1;
            
            if($registro->save())
            {
                $TodosReg=register_document::all();
                //dd($TodosReg);
                foreach($TodosReg as $TR)
                {
                    if($TR->doc_id==$request->txtCodigo)
                    {                        
                        $TR->where('id',$TR->id)->update(['activo'=>'0']);
                        $TR->where('revision',$registro->revision)->update(['activo'=>'1']);
                    }
                }
                $docureg->rev= $request->txtRev ?? "";
                $docureg->fecha=$request->txtFecha;
                $docureg->update(); 
            }
        }
        return redirect('/documentos/documentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\register_document  $register_document
     * @return \Illuminate\Http\Response
     */
    public function show(string $Cod_Selecionado)
    {
        //
        $infoCod=Documento::where('codigo',$Cod_Selecionado)->first();
        //dd($infoCod);
        $listado=register_document::where('documentos.codigo','=',$Cod_Selecionado) 
        ->join('documentos','documentos.id','=','register_documents.doc_id')                  	
        ->select('register_documents.id','register_documents.doc_id as docu','documentos.codigo as cs','nombre_archivo','revision','register_documents.fecha','ruta','register_documents.activo','tipo')        
        ->orderBy('id','desc')
        ->get();
        
        //dd($listado);

        $nivel = Auth::user()->getUserNivel();
        $usuarios = User::where('tipo','Responsable')->orWhere('tipo','Administrador')->get();
        return view('documentos.doc_codigo',[
            'documentos'=>$listado,
            'infocod'=>$infoCod
        ]); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\register_document  $register_document
     * @return \Illuminate\Http\Response
     */
    public function edit(register_document $register_document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateregister_documentRequest  $request
     * @param  \App\Models\register_document  $register_document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //dd($request);
        register_document::where('id',$request->txtIDreg)->update(['activo'=>'0']);
        $year = Carbon::now()->year; // 2022 
        
        $registro = new register_document;        
        $registro->doc_id=$request->txtCodigoEdit;
        $registro->nombre_archivo = $request->txtTituloEdit;
        $registro->revision = $request->txtRevEdit ?? "";
        $registro->fecha = $request->txtFechaEdit;
        switch($request->txtEditNTipo)
        {
            case 'FINAL':
                if($_FILES['fileEdit']['name'] != "") 
                {
                    $version = $request->txtRevEdit;
                    $dir = 'Documentos\\' . $request->txtCodElegEdit . '\\'.$year.'\\' .$version. '\\' . $request->txtTituloEdit . '_Final.' . $request->file('fileEdit')->extension();
                    $path = 'public\\' . $dir;                   

                    if(file_exists($path))
                    {
                    // si ya hay un archivo con el mismo nombre se va a remplazar
                        Storage::deleteDirectory($dir);
                    }
                    Storage::put($path, file_get_contents($request->file('fileEdit')));                    
                }
                $registro->tipo="FINAL";
                break;
            case 'EDITABLE':
                if($_FILES['fileSourceEdit']['name'] != "") 
                {
                    $version = $request->txtRevEdit;
                    $dir = 'Documentos\\' . $request->txtCodElegEdit . '\\'.$year.'\\' .$version. '\\' . $request->txtTituloEdit . '_Editable.' . $request->file('fileSourceEdit')->extension();
                    $path = 'public\\' . $dir;                   

                    if(file_exists($path))
                    {
                    // si ya hay un archivo con el mismo nombre se va a remplazar
                        Storage::deleteDirectory($dir);
                    }
                    Storage::put($path, file_get_contents($request->file('fileSourceEdit')));                    
                }
                $registro->tipo="EDITABLE";      
                break;
            default:
                break;
        }
        
        $registro->ruta=$dir ?? "";
        
        $registro->activo=1;
        $registro->estatus=1;
        $registro->save(); 
        return redirect('/documentos/documentos/'.$request->txtCodElegEdit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\register_document  $register_document
     * @return \Illuminate\Http\Response
     */
    public function destroy(register_document $register_document)
    {
        //
    }

    public function editdocu(string $idSelecc)
    {
        $infods=register_document::find($idSelecc);        
        return $infods;
    }

    public function viewDocumento(register_document $documento)
    {
        $actdocvacio=new register_document;        
        $IDRUTA="";
        $ruta=register_document::find($documento->id);
        /*foreach($Ruta as $RI)
        {
            $RF=$RI['ruta'];
            $IDRUTA=$RI['id'];
            break;                    
        }*/
        $path = 'storage/' . $ruta->ruta;
        
        if(file_exists($path))
        {
            return response()->file($path);           
        }
        else
        {            
            $actdocvacio->where('id',$ruta->id)->update(['ruta'=>'']);
            return "No hay archivo";
        }
    }
}
