@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formatos llenos
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <button class="btn btn-success" onclick="verForm()" style="display: none">Nuevo <i class="fa-solid fa-plus"></i></button>
                <br>
                <div id="frm_nuevo" style="display:none;">
                    <form action="/documentos/formatos_llenos/{{$formatos_llenos[0]->codigo}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                        <!-- <div class="col-lg-1 controlDiv" >
                            <label class="form-label">Folio:</label>
                            <input type="text" class="form-control" id="txtFolio" name="txtFolio" value="">  
                        </div> -->
                            <div class="col-lg-3 controlDiv" >
                                <label class="form-label">Código:</label>
                                <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" value="">       
                            </div>
                            <div class="col-lg-7 controlDiv" >
                                <label class="form-label">Titulo:</label>
                                <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" value="">       
                            </div>
                            <div class="col-lg-2 controlDiv" >
                                <label class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="txtFecha" name="txtFecha" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 controlDiv" >
                                <label class="form-label">Archivo:</label>
                                <input type="file" class="form-control" id="txtArchivo" name="file" accept="application/pdf">       
                            </div>
                            <div class="col-lg-6 controlDiv" >
                                <label class="form-label">Adjuntos:</label>
                                <input type="file" class="form-control" id="txtEvidencias" name="evidencias[]" multiple>       
                            </div>
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Descripción:</label>
                            <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" maxlenght="100"></textarea>
                        </div>

                        <input type="hidden" name="formato_lleno_id" id="formato_lleno_id" value="">                    
                        <input type="submit" class="btn btn-success" style="float:right;" value="Guardar">                    
                    </form>
                    <button class="btn btn-danger" onclick="ocultarForm()" style="float:right; position:relative; left:-5px;">Cancelar</button> 
                    <br>
                </div>          

                <h5 class="separtor">Registros</h5>

                <table class="table tbl-reg table-sm table-hover">
                    <thead>
                        <tr>
                            @switch($userlog->tipo)
                                @case('Administrador')
                                    <th scope="col">#</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Carpeta</th>
                                    <th scope="col">Archivo</th>
                                    <th scope="col">Configuración</th>
                                    @break
                                @default
                                    <th scope="col">#</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Carpeta</th>
                                    <th scope="col">Archivo</th>
                                    @break
                            @endswitch
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($formatos_llenos as $formato)
                            <tr>
                                @switch($userlog->tipo)
                                    @case ('Administrador')
                                        <td>{{ $formato->id }}</td>
                                        <td>{{ $formato->codigo }}</td>
                                        <td>{{ $formato->titulo }}</td>                                        
                                        @foreach($users as $user)   
                                            @if($formato->codigo==$user->codigo)
                                                @if($user->estatus<>'0')
                                                    <td>{{ $user->name ? $user->name :  'NO-Existe'}}</td>
                                                @else
                                                    <td>NO-Existe</td>
                                                @endif
                                                @break
                                            @endif
                                        @endforeach
                                        <td><button type="button" class="btn btn-light" onclick="window.location.href='/documentos/formatos_llenos/{{$formato->codigo}}'"><i class="far fa-folder-open"></i></button></td>
                                        @if(!empty($archivos))
                                            @foreach($archivos as $archivo)
                                                @if($formato->codigo == $archivo->codigo)
                                                    <td><a href="/documentos/documentos_view/{{ $archivo->rd_id }}" target="_blank"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-pdf"></i></a></td>
                                                    {{$aux=true}}
                                                    @break
                                                @endif
                                                {{$aux=false}}
                                            @endforeach
                                            @if($aux==false)
                                                <td><i class="fa-solid fa-square-xmark" style="color:red"></i> NO-Existe</td>
                                            @endif
                                        @else
                                            <td><i class="fa-solid fa-square-xmark" style="color:red"></i> NO-Existe</td>
                                        @endif
                                        <td><button type="button" class="btn btn-light" onclick="window.location.href='/documentos/formatos_llenos/config/{{$formato->codigo}}'"><i class="fas fa-cogs"></i></button></td>
                                        @break
                                    @default
                                        <td>{{ $formato->id }}</td>
                                        <td>{{ $formato->codigo }}</td>
                                        <td>{{ $formato->titulo }}</td>                                        
                                        @foreach($users as $user)
                                            @if($formato->codigo==$user->codigo)
                                                <td>{{$user->name}}</td>
                                                @break
                                            @endif
                                        @endforeach
                                        <td><button type="button" class="btn btn-light" onclick="window.location.href='/documentos/formatos_llenos/{{$formato->codigo}}'"><i class="far fa-folder-open"></i></button></td>
                                        @if(!empty($archivos))
                                            @foreach($archivos as $archivo)
                                                @if($formato->codigo == $archivo->codigo)
                                                    <td><a href="/documentos/documentos_view/{{ $archivo->rd_id }}" target="_blank"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-pdf"></i></a></td>
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                            <td><i class="fa-solid fa-square-xmark" style="color:red"></i> NO-Existe</td>
                                        @endif
                                        @break
                                @endswitch
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>

    function verForm()
    {
        limpiarForm();
        $("#frm_nuevo").show(); 
    }
    function ocultarForm()
    {
        $("#frm_nuevo").hide(); 
        limpiarForm();
    }
    function limpiarForm()
    {
        $("#txtCodigo").val(""); 
        $("#txtTitulo").val(""); 
        $("#txtFecha").val(""); 
        $("#txtArchivo").val(""); 
        $("#txtDescripcion").val(""); 
        $("#formato_lleno_id").val(""); 
    }

    function editar(id)
    {
        limpiarForm();
        $.ajax({url: "/documentos/formatos_llenos/"+id,context: document.body}).done(function(result) 
        {
            $("#txtCodigo").val(result["codigo"]); 
            $("#txtTitulo").val(result["titulo"]); 
            $("#txtFecha").val(result["fecha"].split(" ")[0]); 
            $("#txtArchivo").val(""); 
            $("#txtDescripcion").val(result["descripcion"]); 
            $("#formato_lleno_id").val(result["id"]); 
            $("#frm_nuevo").show(); 
        });
    }

    function eliminar(id)
    {
        if(!confirm("Desea eliminar el registro?" ))
        {
            return;
        }
        $.ajax({url: "/documentos/formatos_llenos_delete/"+id,context: document.body}).done(function(result) 
        {
            showModal('Notificación','Registro eliminado!');
            window.location.reload();
        });
    }
    function showAdjuntos(content_row)
    {
        var html = $("#"+content_row).html();  
        showModal("Adjuntos",html.replace(/src_aux/g, "src"));
    }



</script>
@endsection