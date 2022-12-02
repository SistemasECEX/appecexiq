@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Pendientes
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

            <button class="btn btn-success" onclick="verForm()" >Nuevo <i class="fa-solid fa-plus"></i></button>
            <br>
            <div id="frm_nuevo" style="display:none;">

                <form action="/inicio/actas_de_reunion_guardar" method="post" enctype="multipart/form-data">
                @csrf


                



                    <div class="row">
                        <!-- <div class="col-lg-1 controlDiv" >
                            <label class="form-label">Folio:</label>
                            <input type="text" class="form-control" id="txtFolio" name="txtFolio" value="">  
                        </div> -->
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="">       
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Tipo de Archivo:</label>
                            <select class="form-select" id = "txtTipoDeArchivo" name = "txtTipoDeArchivo">
                                <option value="Archivo1">Archivo1</option>
                                <option value="Archivo2">Archivo2</option>
                            </select>
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Fecha:</label>
                            <input type="date" class="form-control" id="txtFecha" name="txtFecha" value="">
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Puntos:</label>
                            <input type="text" class="form-control" id="txtPuntos" name="txtPuntos" value="">       
                        </div>
                        <div class="col-lg-3 controlDiv" >
                            <label class="form-label">Archivo:</label>
                            <input type="file" class="form-control" id="txtArchivo" name="file" accept="application/pdf">       
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
                        <div class="col-lg-1 controlDiv" >
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="chkActivo" id="chkActivo" name="chkActivo">
                                <label class="form-check-label">Activo</label>
                            </div>      
                        </div>
                    </div>
                    

                    <input type="hidden" name="acta_id" id="lista_id" value="">

                    
                    <input type="submit" class="btn btn-success" style="float:right;" value="Guardar">
                    
                </form>
                <button class="btn btn-danger" onclick="ocultarForm()" style="float:right; position:relative; left:-5px;">Cancelar</button> 
                <br>
            </div>

            

            <h5 class="separtor">Registros</h5>

            <table class="table tbl-reg table-sm table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Puntos</th>
                    <th scope="col">Activo</th>
                    <th scope="col"><i class="fa-solid fa-download"></i></th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendientes as $pendiente)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pendiente->nombre }}</td>
                        <td>{{ $pendiente->tipo_de_archivo }}</td>
                        <td>{{ $pendiente->fecha }}</td>
                        <td>{{ $pendiente->puntos_urgente }}</td>
                        <td>{{ $pendiente->activo }}</td>
                        <td>{{ $pendiente->responsable_id }}</td>
                        <td><a href="/inicio/lista_de_pendientes_view/{{ $pendiente->id }}"><i style="color: #CCC;font-size:35px;" class="fa-solid fa-file-pdf"></i></a></td>
                        <td><button class="btn btn-success" onclick="editar({{ $pendiente->id }})"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        <td><button class="btn btn-success" onclick="eliminar({{ $pendiente->id }})"><i class="fa-solid fa-xmark"></i></button></td>
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

        // $("#txtFolio").val(""); 
        $("#txtNombre").val(""); 
        $("#txtTipoDeArchivo").val(""); 
        $("#txtFecha").val(""); 
        $("#txtPuntos").val(""); 
        $("#txtArchivo").val(""); 
        $("#txtResponsable").val(""); 
        $("#chkActivo").val(""); 
        $("#lista_id").val(""); 
        
    }

    function editar(id)
    {
        limpiarForm();
        $.ajax({url: "/inicio/actas_de_reunion/"+id,context: document.body}).done(function(result) 
        {
            // $("#txtFolio").val(result["folio"]); 
            $("#txtEntidad").val(result["entidad"]); 
            $("#txtFecha").val(result["fecha"].split(" ")[0]); 
            $("#txtLugar").val(result["lugar"]); 
            $("#txtEstado").val(result["estado"]); 
            $("#txtArchivo").val(""); 
            $("#txtObjetivo").val(result["objetivo"]); 
            $("#acta_id").val(result["id"]); 
            $("#frm_nuevo").show(); 
        });
    }

    function eliminar(id)
    {
        if(!confirm("Desea eliminar el registro?" ))
        {
            return;
        }
        $.ajax({url: "/inicio/actas_de_reunion_delete/"+id,context: document.body}).done(function(result) 
        {
            showModal('Notificación','Registro eliminado!');
            window.location.reload();
        });
    }



</script>
@endsection