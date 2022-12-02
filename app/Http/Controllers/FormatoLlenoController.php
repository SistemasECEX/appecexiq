<?php

namespace App\Http\Controllers;

use App\Models\FormatoLleno;
use App\Models\formatosllenos_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FormatoLlenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fllusuarios=[];
        $userlog=Auth::user();
        /*$formatos_llenos = FormatoLleno::select('formatos_llenos.id as id', 'formatos_llenos.codigo as codigo', 'formatos_llenos.titulo as titulo', 'formatos_llenos.responsable as responsable','users.name as nombre')
            ->join('users','users.id','=','formatos_llenos.responsable')->get();*/
        switch($userlog->tipo)
        {
            case'Administrador':
                $formatos_llenos=FormatoLleno::all();
                
                break;
            default;
                $formatos_llenos=formatosllenos_user::where('users_id','=',$userlog->id)
                    ->join('formatos_llenos','formatos_llenos.id','=','formatosllenos_users.formatos_llenos_id')
                    ->select('formatosllenos_users.id as id','formatos_llenos.codigo as codigo','formatos_llenos.titulo as titulo','formatos_llenos.periodo as periodo')
                    ->get();       
                break;
        }
        $userFll=formatosllenos_user::select( 'formatosllenos_users.id','fll.codigo','users.name','formatosllenos_users.status as estatus')
                ->leftJoin('formatos_llenos as fll','fll.id','formatosllenos_users.formatos_llenos_id')
                ->leftJoin('users','users.id','formatosllenos_users.users_id')
                ->get();
                
        $archivos=FormatoLleno::where([['register_documents.activo','1'],['register_documents.tipo','FINAL']])
        ->select('formatos_llenos.id AS id','formatos_llenos.codigo AS codigo','formatos_llenos.titulo AS titulo','documentos.id AS id_doc','register_documents.id AS rd_id','register_documents.doc_id AS doc_id','register_documents.ruta AS ruta')
        ->join('documentos', 'documentos.codigo','=','formatos_llenos.codigo')
        ->join('register_documents','register_documents.doc_id','=','documentos.id')    
        ->get();
        
        //$formatos_llenos=null;
       
        return view('documentos.formatos_llenos', [
            'formatos_llenos' => $formatos_llenos,
            'userlog'=>$userlog,
            'users'=>$userFll,
            'archivos'=>$archivos
        ]);
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
        //
        $registro = false;
        if(isset($request->formato_lleno_id))
        {
            $registro = FormatoLleno::find($request->formato_lleno_id);
        }
        
        if(!$registro) // en caso de ser update
        {
            $registro = new FormatoLleno;
        }

        $registro->codigo = $request->txtCodigo ?? "";
        $registro->titulo = $request->txtTitulo ?? "";
        $registro->fecha = $request->txtFecha;
        $registro->descripcion = $request->txtDescripcion ?? "";

        if($registro->save())
        {
            //archivo
            if($_FILES['file']['name'] != "") 
            {
                $path_archivo_public = 'public/Archivos/Formatos_Llenos/' . $registro->id . '/' . $registro->id . ".pdf";
                $path_archivo_storage = 'storage/Archivos/Formatos_Llenos/' . $registro->id . '/' . $registro->id . ".pdf";

                //$path_adjuntos = 'storage/Archivos/Formatos_Llenos/' . $registro->id . '/adjuntos/' . $request->file('file')->extension();

                if(file_exists($path_archivo_storage))
                {
                    // si ya hay un archivo con el mismo nombre se va a remplazar
                    Storage::delete($path_archivo_public);
                }
                Storage::put($path_archivo_public, file_get_contents($request->file('file')));
            }

            if($request->file('evidencias') !== null) 
            {
                //adjuntos
                if(file_exists('storage/Archivos/Formatos_Llenos/' . $registro->id . '/adjuntos'))
                {
                    // si ya hay un archivo con el mismo nombre se va a remplazar
                    Storage::deleteDirectory('public/Archivos/Formatos_Llenos/' . $registro->id . '/adjuntos');
                }
                $i = 0;
                foreach ($request->file('evidencias') as $file) 
                {
                    $i++;
                    $path_adjuntos_public = '/public/Archivos/Formatos_Llenos/' . $registro->id . '/' . 'adjuntos/' . $i . "." . $file->extension();    
                    Storage::put($path_adjuntos_public, file_get_contents($file));
                }
            }
        }


        return redirect('/documentos/formatos_llenos');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\formato_lleno  $formato_lleno
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        /*$formato = FormatoLleno::find($id);
        return $formato;*/
        return view ('documentos.fll_codigo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\formato_lleno  $formato_lleno
     * @return \Illuminate\Http\Response
     */
    public function edit(formatolleno $formato_lleno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\formato_lleno  $formato_lleno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, formatolleno $formato_lleno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\formato_lleno  $formato_lleno
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormatoLleno $formato)
    {
        $id = $formato->id;
        if($formato->delete())
        {
            Storage::deleteDirectory('public/Archivos/Formatos_Llenos/' . $id);
        }
    }

    public function viewFormatoLlenoDeReunion(FormatoLleno $formato)
    {
        $path_archivo_storage = 'storage/Archivos/Formatos_Llenos/' . $formato->id . '/' . $formato->id . ".pdf";

        if(file_exists($path_archivo_storage))
        {
            return response()->file($path_archivo_storage);
        }
        return "No hay archivo";
    }

    public function configcodigo(string $codigo)
    {
        //return "CONFIGURACIÓN DE FORMATO LLENO";
        //$usuarios=formatosllenos_user::where()
        $usuarios=formatosllenos_user::where([['formatos_llenos.codigo',$codigo],['formatosllenos_users.status','1']])
        ->join('formatos_llenos','formatos_llenos.id','=','formatosllenos_users.formatos_llenos_id')
        ->join('users','users.id','=','formatosllenos_users.users_id')
        ->select('formatosllenos_users.id AS ID','formatos_llenos.codigo AS codigo','formatos_llenos.titulo AS titulo','formatosllenos_users.users_id AS iduser','users.name AS usuario')
        ->get(); 

        $selectuser=User::all();
        $infoper=FormatoLleno::where('codigo','=',$codigo)->get();
        $periodo=$infoper[0]->periodo;

        return view('documentos.fll.configuracion',[
            'cod_eleg'=>$codigo,
            'usuarios'=>$usuarios,
            'selectuser'=>$selectuser,
            'periodo'=>$periodo
        ]);
    }

    public function periodocodigo(Request $request)
    {        
        return redirect('/documentos/formatos_llenos');
    }

    public function saveuser(string $idUserCod)
    {
        return "Hola mundo";
    }
}
