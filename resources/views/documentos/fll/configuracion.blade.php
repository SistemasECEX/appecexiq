@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formatos llenos + {{$cod_eleg}} => Configuración
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h5 class="separtor">Periodicidad</h5>
                
                <div id="frm_nuevo" style="display:inline;">
                    <form action="/documentos/formatos_llenos/config/saveperiodo" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 controlDiv" >
                                <label class="form-label">Periodo:</label>
                                <select class="form-select" id = "periodo" name = "txtPeriodo">
                                    <option value="Diario">Diario</option>
                                    <option value="Semanal">Semanal</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Anual">Anual</option>
                                    <option value="Eventual">Eventual</option>                                    
                                </select>
                                @if($periodo<>"")
                                    <label class="form-label">Periodo: {{$periodo}}</label>
                                @else
                                    <label class="form-label">Periodo: Sin asignar</label>
                                @endif
                            </div>
                            <div class="col-lg-3 controlDiv" >
                                <label class="form-label">Fecha Inicial:</label>
                                <input type="date" class="form-control" id="fechaini" name="fechanow" value="">       
                            </div>
                            <div class="col-lg-3 controlDiv" >
                                <label class="form-label">Fecha Siguiente:</label>
                                <input type="date" class="form-control" id="fechasig" name="fechanext" value="">
                            </div>
                            <div class="col-lg-3 controlDiv" >
                                <input type="text" class="form-control" id="txtcodigo" name="txtCodigo" value="{{$cod_eleg}}" style="display: none">
                            </div>                            
                        </div>
                        <input type="submit" class="btn btn-success" style="float:right;" value="Guardar / Actualizar">                    
                    </form>
                    <button class="btn btn-danger" onclick="#" style="float:right; position:relative; left:-5px;">Cancelar</button> 
                    <br>
                </div>            

                <h5 class="separtor">Usuarios Asignados</h5>
                <div class="col-lg-3 controlDiv" >
                    <select class="form-select" id = "usuarios" name = "txtUsuarios">
                        @foreach($selectuser as $su)
                            <option value="{{$su->id}}">{{$su->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" onclick="adduser({{$su->id}})" >Agregar <i class="fa-solid fa-plus"></i></button>
                </div>
                <br>
                <table class="table tbl-reg table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="display: none">IDUSER</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="display: none">{{ $usuario->iduser }}</td>
                                <td>{{ $usuario->usuario }}</td>
                                <td><button class="btn btn-success" onclick="deleteuser('{{$usuario->usuario}}')"><i class="fa-solid fa-xmark"></i></button></td>
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

    function adduser(id)
    {
        alert("ejemplo");
        $.ajax({url: "/documentos/formatos_llenos/config/saveuser/"+id,context: document.body}).done(function(result) 
        {
            alert(result);
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

    function deleteuser(id)
    {
        alert(id);
    }

</script>
@endsection