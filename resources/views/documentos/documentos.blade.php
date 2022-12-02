@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Documentos (Lista Maestra)
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            @if ($nivel > 1) 
            <button class="btn btn-success" onclick="verForm()">Nuevo <i class="fa-solid fa-plus"></i></button>
            @endif
            <br>
            <!-- <div id="frm_nuevo" style="display:none;"> -->
            <div id="frm_nuevo" style="display:none;">

                <form action="/documentos/registrar" method="post" enctype="multipart/form-data">
                @csrf

                    <div class="row">
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Código:</label>
                            <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" value="" required>  
                        </div>
                        <div class="col-lg-5 controlDiv" >
                            <label class="form-label">Titulo:</label>
                            <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" value="" required>       
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Responsable:</label>
                            <select class="form-select" id = "txtResponsable" name = "txtResponsable" required>
                                <option value=""></option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                            </select>      
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" style="float:right;" value="Guardar">                    
                </form>
                <button class="btn btn-danger" onclick="ocultarForm()" style="float:right; position:relative; left:-5px;">Cancelar</button> 
                <br>
            </div>           

            <h5 class="separtor">Registros</h5>

            <div class="row">
                <div class="col-lg-4">
                </div>

                <div class="col-lg-2 controlDiv" >
                </div>

                <div class="col-lg-2 controlDiv" >                  
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
                    <th scope="col">Código</th>
                    <th scope="col" style="max-width:350px">Titulo</th>
                    <th scope="col">Revisión</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Registro</th>                    
                    </tr>
                </thead>
                <tbody id="tbl_Documentos">
                    @foreach ($documentos as $documento)
                    <tr>
                        <td>{{ $documento->id }}</td>
                        <td>{{ $documento->codigo }}</td>
                        <td style="max-width:300px">{{ $documento->titulo }}</td>
                        <td>{{ $documento->rev }}</td>
                        <td>{{ explode(" ",$documento->fecha)[0] }}</td>
                        <td>{{ $documento->responsable()->name }}</td>
                        <td><button type="button" class="btn btn-light" onclick="window.location.href='/documentos/documentos/{{$documento->codigo}}'"><i class="far fa-folder-open"></i></button></td>                        
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
        $("#txtRev").val(""); 
        $("#txtFecha").val(""); 
        $("#txtResponsable").val(""); 
        $("#txtEstado").val(""); 
        $("#chkActivo").prop('checked', false);
        $("#documento_id").val(""); 
    }

    function editar(id)
    {
        limpiarForm();
        $.ajax({url: "/documentos/documentos/"+id,context: document.body}).done(function(result) 
        {
            $("#txtCodigo").val(result["codigo"]); 
            $("#txtTitulo").val(result["titulo"]); 
            $("#txtRev").val(result["rev"]);
            $("#txtFecha").val(result["fecha"].split(" ")[0]); 
            $("#txtResponsable").val(result["responsable_id"]); 
            $("#txtEstado").val(result["estado"]); 
            $("#chkActivo").prop('checked', result["activo"]);
            $("#documento_id").val(result["id"]); 
            $("#frm_nuevo").show();
            $("#txtCodigo").focus(); 
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
                    $(this).text().toLowerCase().indexOf(value) > -1 
                )
        });
    }



</script>
@endsection