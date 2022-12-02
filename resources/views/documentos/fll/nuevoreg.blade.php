@extends('layouts.common')
@section('headers')
@endsection
@section('content')
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formatos llenos + Nuevo Registro => {{$codigo}}
        </h2>
    </div>
</header>

<!-- Page Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h5 class="separtor">Cargar Documento</h5>
                
                <div id="frm_documento" style="display:inline;">
                    <form action="/documentos/formatos_llenos/nuevoreg/guardar" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 controlDiv" >
                                <label class="form-label">Archivo:</label>
                                <input type="file" class="form-control" id="txtArchivo" name="file"/ required>                                
                            </div> 
                            <div class="col-lg-6 controlDiv" >
                                <label class="form-label">Descripción:</label>
                                <textarea rows="3" cols="1" class="form-control" id="txtDescripcion" name="descripcion"></textarea>
                            </div>                            
                        </div>
                        <h5 class="separtor">Anexos y/o Evidencias</h5>               
                        <br>                
                        <div class="row">
                            <div class="col-lg-6 controlDiv" >
                                <label class="form-label">Adjuntos:</label>
                                <input type="file" class="form-control" id="txtEvidencias" name="evidencias[]" multiple>                                   
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6 controlDiv" >                                
                                <input type="text" class="form-control" id="txtEvidencias" name="txtCodigo" value="{{$codigo}}" style="display: none">
                            </div>                            
                        </div>
                        <input type="submit" class="btn btn-success" style="float:right;" value="Guardar">
                    </form>
                    <button class="btn btn-danger" onclick="cancelado('{{$codigo}}')" style="float:right; position:relative; left:-5px;">Cancelar</button> 
                    <br>
                </div>     
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function cancelado(id)
    {        
        //windows.open("/documentos/formatos_llenos/"+id);
        window.location.href="/documentos/formatos_llenos/"+id;
    }
</script>
@endsection