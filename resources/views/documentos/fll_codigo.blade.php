@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formatos llenos + {{$cod_selec}}
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <button class="btn btn-success" onclick="nuevoregistro('{{$cod_selec}}')" style="display:inline">Nuevo <i class="fa-solid fa-plus"></i></button>
                <h5 class="separtor">Registros </h5>
                <table class="table tbl-reg table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Nombre Archivo</th>
                            <th scope="col">Descripción</th>                    
                            <th scope="col">Archivo</th>
                            <th scope="col">Anexos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registros_llenos as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->fecha }}</td>
                            <td>{{ $registro->nombre_archivo}}</td>                        
                            <td>{{ $registro->descripcion }}</td>
                            <td> @if($registro->ruta<> "")                                
                                    <a href="/documentos/formatos_llenos_view/{{$registro->id}}" target="_blank"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-pdf"></i></a>
                                @endif
                            </td>
                            
                            <td>@if($registro->anexos <> "No")
                                    <button id="btnmostrar" type="button" class="btn btn-light" onclick="mostraranexos({{$registro->id}})"><i class="far fa-folder-closed"></i></button>
                                    <button type="button" class="btn btn-light" onclick="ocultaranexos()" id="btnocultar" style="display: none"><i class="far fa-folder-open"></i></button>
                                @endif
                            </td>
                                                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="anexos" style="display:none">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="table tbl-reg table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>                            
                            <th scope="col">Nombre Archivo</th>                            
                            <th scope="col">Archivo</th>
                        </tr>
                    </thead>
                    <tbody id="body">                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function nuevoregistro(id)
    {
        //alert("Registro nuevo para: "+id);
        window.location.href="/documentos/formatos_llenos/nuevoreg/"+id;
        //window.open('/documentos/formatos_llenos/nuevoreg/'+id,'_blank');
    }

    function mostraranexos(id)
    {
        $.ajax({url: "/documentos/formatos_llenos_anexos/view/"+id, context: document.body}).done(function(result)
        {
            //alert(result[0]["nombre_archivo"]);
            //alert(result.length); //registros            
            $('#anexos').show();
            $('#btnmostrar').css('display','none');
            $('#btnocultar').css('display','inline');
            
            //$('#renglon').html('<td id="numanexo">NUMERO-2</td> <td>ARCHIVO-2</td> <td>ICONO-2</td>');
            //$('#renglon').innerhtml('<td id="numanexo">NUMERO-3</td> <td>ARCHIVO-3</td> <td>ICONO-3</td>');
            for (let i = 0; i < result.length; i++) 
            {
                document.getElementById("body").innerHTML += '<tr> <td>'+result[i]['id']+'</td> <td>'+result[i]["nombre_archivo"]+'</td> <td> <a href="/documentos/formatos_llenos_anexos/veranexo/'+result[i]['id']+'" target="_blank"><i style="color: rgb(6, 126, 12);font-size:35px;" class="fa-solid fa-file-pdf"></i></a> </td></tr>';
            }
        });
    }

    function ocultaranexos()
    {
        $('#anexos').hide();
        $('#btnmostrar').css('display','inline');
        $('#btnocultar').css('display','none');
    }
</script>
@endsection