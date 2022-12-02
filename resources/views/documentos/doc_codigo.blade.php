@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Documentos
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <button id="nuevoReg" class="btn btn-success" onclick="verForm()" >Nuevo <i class="fa-solid fa-plus"></i></button>
                <br>
                <div id="frm_nuevo" style="display:none;">
                    <form action="/documentos/documentos_guardar" method="post" enctype="multipart/form-data">
                        @csrf    
                        <div class="row">                                                
                            <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" value="{{$infocod->id}}" style="display:none">
                            <input type="text" class="form-control" id="txtCodEleg" name="txtCodEleg" value="{{$infocod->codigo}}" style="display:none">
                            
                            <div class="col-lg-5 controlDiv" >
                                <label class="form-label">Nombre Archivo:</label>
                                <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" value="" required>       
                            </div>   
                            
                            <div class="col-lg-2 controlDiv" >
                                <label class="form-label">Revisión:</label>
                                <input type="text" class="form-control" id="txtRev" name="txtRev" value="" required>       
                            </div>
                            
                            <div class="col-lg-2 controlDiv" >
                                <label class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="txtFecha" name="txtFecha" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="row">    
                                <div class="col-lg-4 controlDiv" >
                                    <label class="form-label">Archivo Final: <i class="fa-solid fa-file-pdf"></i></label>
                                    <input type="file" class="form-control" id="txtArchivo" name="file">       
                                </div>    
                                
                                <div class="col-lg-4 controlDiv" >
                                    <label class="form-label">Archivo Editable: <i class="fa-solid fa-file-word"></i> <i class="fa-solid fa-file-excel"></i></label>
                                    <input type="file" class="form-control" id="txtArchivoFuente" name="fileSource">       
                                </div>
                            </div>                             
                            <br>
                        </div>
                        <input type="submit" class="btn btn-success" style="float:right;" value="Guardar"> 
                    </form>    
                    <button class="btn btn-danger" onclick="ocultarForm()" style="float:right; position:relative; left:-5px;">Cancelar</button>
                </div>
                
                <div id="frm_edit" style="display:none;">
                    <form action="/documentos/documentos_editar" method="post" enctype="multipart/form-data">
                        @csrf    
                        <div class="row">                                                
                            <input type="text" class="form-control" id="txtCodigoEdit" name="txtCodigoEdit" value="{{$infocod->id}}" style="display:none">
                            <input type="text" class="form-control" id="txtCodElegEdit" name="txtCodElegEdit" value="{{$infocod->codigo}}" style="display:none">
                            <input type="text" class="form-control" id="txtIDReg" name="txtIDreg" value="" style="display:none">
                                
                            <div class="col-lg-5 controlDiv" >
                                <label class="form-label">Nombre Archivo:</label>
                                <input type="text" class="form-control" id="txtTituloEdit" name="txtTituloEdit" value="">       
                            </div>   
                        
                            <div class="col-lg-2 controlDiv" >
                                <label class="form-label">Revisión:</label>
                                <input type="text" class="form-control" id="txtRevEdit" name="txtRevEdit" value="">       
                            </div>
                        
                            <div class="col-lg-2 controlDiv" >
                                <label class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="txtFechaEdit" name="txtFechaEdit" value="">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="row">                               
                                <div class="col-lg-4 controlDiv" >
                                    <label class="form-label" style="display: none" id="lblafedit">Archivo Final: <i class="fa-solid fa-file-pdf"></i></label>
                                    <input type="file" class="form-control" id="txtafedit" name="fileEdit" style="display: none">       
                                </div>    
                                   
                                <div class="col-lg-4 controlDiv" >
                                    <label class="form-label" style="display: none" id="lbledit">Archivo Editable: <i class="fa-solid fa-file-word"></i> <i class="fa-solid fa-file-excel"></i></label>
                                    <input type="file" class="form-control" id="txtedit" name="fileSourceEdit" style="display: none">
                                </div>
                                <div class="col-lg-2 controlDiv" >
                                    <label class="form-label" style="display: none" id="lbleditTipo">Tipo:</label>
                                    <input type="text" class="form-control" id="txtEditTipo" name="txtEditNTipo" value="" style="display:none" readonly>
                                </div>
                            </div>                             
                            <br>
                        </div>
                        <input type="submit" class="btn btn-success" style="float:right;" value="Actualizar"> 
                    </form>    
                    <button class="btn btn-danger" onclick="ocultarForm()" style="float:right; position:relative; left:-5px;">Cancelar</button>
                </div>

            <h5 class="separtor">Codigo Elegido: {{$infocod->codigo}}</h5>

            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                </div>                 
                <div class="col-lg-4 controlDiv" >
                    <label class="form-label">Buscar:</label>
                    <input type="text" class="form-control" id="txtQuickSearch" placeholder="Busca rapida" onkeyup="filtrar()">   
                </div>
            </div>
            <br>

            <table class="table tbl-reg table-sm table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="max-width:350px">Nombre Archivo</th>
                    <th scope="col">Revisión</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Archivo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody id="tbl_Documentos">
                    @if($documentos<> null)
                        @foreach ($documentos as $documento)
                        <tr>
                            <td>{{ $documento->id }}</td>
                            <td style="max-width:300px">{{ $documento->nombre_archivo }}</td>
                            <td>{{ $documento->revision }}</td>
                            <td>{{ explode(" ",$documento->fecha)[0] }}</td>
                            <td>@if ($documento->ruta<>"")
                                    @if(substr($documento->ruta,-3)=="pdf")
                                        <a href="/documentos/documentos_view/{{ $documento->id }}" target="_blank"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-pdf"></i></a>
                                    @else
                                        @if((substr($documento->ruta,-3)=="doc") || (substr($documento->ruta,-3)=="ocx"))
                                            <a href="/documentos/documentos_view/{{ $documento->id }}"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-word"></i></a>
                                        @else
                                            @if((substr($documento->ruta,-3)=="xls")||(substr($documento->ruta,-3)=="lsx"))
                                                <a href="/documentos/documentos_view/{{ $documento->id }}"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-excel"></i></a>
                                            @else
                                                <a href="/documentos/documentos_view/{{ $documento->id }}"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-regular fa-file-circle-question"></i></a>
                                            @endif
                                        @endif
                                    @endif            
                                @else 
                                    <i class="fa-solid fa-square-xmark" style="color:red"></i> NO-Existe 
                                @endif</td>
                            <td>{{ $documento->tipo }}</td>
                            <td>@if($documento->activo=="1")
                                <i class="fas fa-check-square" style="color:green"></i> Activo 
                                @else
                                <i class="fa-regular fa-circle-stop" style="color:red"></i> In-Activo                            
                                @endif</td>
                            <td><button class="btn btn-success" onclick="editar({{$documento->id}},'{{$documento->nombre_archivo}}')"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>                        
                        @endforeach
                    @endif
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
        $("#frm_edit").hide(); 
        limpiarForm();
    }
    function limpiarForm()
    {
        $("#txtTitulo").val(""); 
        $("#txtRev").val(""); 
        $("#txtFecha").val("");
        $("#txtTituloEdit").val(""); 
        $("#txtRevEdit").val(""); 
        $("#txtFechaEdit").val("");
        $("#nuevoReg").css("display","inline");
    }

    function editar(id,cgo)
    {
        if(!confirm("Desea editar el documento?\r"+id+"-"+cgo))
        {
            return;
        }
        ocultarForm();
        $.ajax({url: "/documentos/documentos/edit/"+id, context: document.body}).done(function(result)
        {
            $("#txtIDReg").val(result["id"]); 
            $("#txtTituloEdit").val(result["nombre_archivo"]); 
            $('#txtEditTipo').val(result["tipo"]);
            $("#txtRevEdit").val(result["revision"]);          
            $("#txtFechaEdit").val(result["fecha"].split(" ")[0]);            
            $("#nuevoReg").css("display","none");
            switch(result["tipo"])
            {
                case "FINAL":
                    $("#lblafedit").css("display","inline");
                    $("#txtafedit").css("display","inline");
                    $("#lbledit").css("display","none");
                    $("#txtedit").css("display","none");
                    break;
                case "EDITABLE":
                    $("#lblafedit").css("display","none");
                    $("#txtafedit").css("display","none");
                    $("#lbledit").css("display","inline");
                    $("#txtedit").css("display","inline");
                    break;
                default:                    
                    break
            }
            $('#lbleditTipo').css("display","inline");
            $('#txtEditTipo').css("display","inline");
            $("#frm_edit").show();            
            $("#txtTituloEdit").focus();
        });
    }

    function eliminar(id)
    {
        if(!confirm("Desea eliminar el documento?" ))
        {
            return;
        }
        $.ajax({url: "/documentos/documentos_delete/"+id,context: document.body}).done(function(result) 
        {
            showModal('Notificación','Documento eliminado!');
            window.location.reload();
        });
    }

    function filtrarEnviadas()
    {
        $("#tbl_Documentos tr").each(function()
            {
                $(this).show();
            });

        if($('#chkActivoFilter').prop('checked'))
        {        

            $("#tbl_Documentos tr").each(function()
            {
                var index = $(this).attr('id').split("_")[2];
                if( $(this).html().includes("In-activo"))
                {
                    $(this).hide();
                }
            });
        }
    }

    function filtrar()
    {
        var value = $("#txtQuickSearch").val().toLowerCase();        
        $("#tbl_Documentos tr").filter(function() 
        {
            $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1)
        });
    }
</script>
@endsection