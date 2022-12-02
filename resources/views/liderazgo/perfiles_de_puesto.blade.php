@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfiles de puesto
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

                <form action="/liderazgo/perfiles_de_puesto_guardar" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-lg-3 controlDiv" >
                            <label class="form-label">Código:</label>
                            <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" value="" required>  
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="" required>       
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Revisión:</label>
                            <input type="text" class="form-control" id="txtRev" name="txtRev" value="" required>       
                        </div>
                        <div class="col-lg-2 controlDiv" >
                            <label class="form-label">Fecha:</label>
                            <input type="date" class="form-control" id="txtFecha" name="txtFecha" value="" required>
                        </div>
                        <div class="col-lg-3 controlDiv" >
                            <label class="form-label">Archivo:</label>
                            <input type="file" class="form-control" id="txtArchivo" name="file" accept="application/pdf">       
                        </div>
                    </div>

                    <input type="hidden" name="perfil_id" id="perfil_id" value="">

                    <br>
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
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Revisión</th>
                    <th scope="col">Fecha</th>
                    <th scope="col"><i class="fa-solid fa-download"></i></th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perfiles__de_puesto as $perfil)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $perfil->codigo }}</td>
                        <td>{{ $perfil->nombre }}</td>
                        <td>{{ $perfil->rev }}</td>
                        <td>{{ $perfil->fecha }}</td>
                        <td><a href="/liderazgo/perfiles_de_puesto_view/{{ $perfil->id }}"><i style="color: #CCC;font-size:35px;" class="fa-solid fa-file-pdf"></i></a></td>
                        <td><button class="btn btn-success" onclick="editar({{ $perfil->id }})"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        <td><button class="btn btn-success" onclick="eliminar({{ $perfil->id }})"><i class="fa-solid fa-xmark"></i></button></td>
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
        $("#txtNombre").val(""); 
        $("#txtRev").val(""); 
        $("#txtFecha").val(""); 
        $("#txtArchivo").val(""); 
        $("#perfil_id").val(""); 
        
    }

    function editar(id)
    {
        limpiarForm();
        $.ajax({url: "/liderazgo/perfiles_de_puesto/"+id,context: document.body}).done(function(result) 
        {
            $("#txtCodigo").val(result["codigo"]); 
            $("#txtNombre").val(result["nombre"]); 
            $("#txtRev").val(result["rev"]); 
            $("#txtFecha").val(result["fecha"].split(" ")[0]);             
            $("#txtArchivo").val(""); 
            $("#perfil_id").val(result["id"]); 
            $("#frm_nuevo").show(); 
        });
    }

    function eliminar(id)
    {
        if(!confirm("Desea eliminar el registro?" ))
        {
            return;
        }
        $.ajax({url: "/liderazgo/perfiles_de_puesto_delete/"+id,context: document.body}).done(function(result) 
        {
            showModal('Notificación','Registro eliminado!');
            window.location.reload();
        });
    }



</script>
@endsection