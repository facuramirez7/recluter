@extends('layouts.admin.base')

@section('title')
<title>Crear Empresa</title>
@endsection

@section('description')
<meta name="description" content="Crear empresa">
@endsection

@section('content-title')
Empresa
@endsection

@section('content-subtitle')
Crear
@endsection

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <form action="{{route('empresas.store')}}" method="POST" id="agregar-producto" class="col-md-10 mx-auto" enctype='multipart/form-data'>
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row mb-3">
                <h5 class="card-title ml-auto mr-auto">INFORMACION DE LA EMPRESA</h5>
            </div>
            <div class="form-row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="position-relative form-group">
                        <label for="nombre">Nombre de la Empresa</label>
                        <div class="mb-3">
                            <input required type="text" class="form-control" id="name" name="name"
                                placeholder="Introduzca el nombre de la empresa" value="{{ old('name') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2 text-center">
                    <img id="imgPreview" src="" style="max-height:120px; max-width: 120px; border-style : solid; border-width:1px; border-radius: 16px; padding: 20px;"> <br>
                    <small>Logo de la empresa</small> <br>
                    <div class="picture-container form-group">
                        <input type="file" name="photo" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                        <small>JPG o PNG</small>
                    </div>
                </div>

                <div class="col-md-12 order-3">
                    <div class="position-relative form-group">
                        <label for="description">Descripión</label>
                        <textarea rows="1" placeholder="Ingrese una descripción del producto..."
                            class="form-control autosize-input" style="height: 77px;" name="description" idea
                            id="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-left">
                <span><strong>*</strong> : Indica que el campo es obligatorio</span>
            </div>
            <div class="form-group row justify-content-center">
                <button type="submit" class="btn btn-success" name="crear"><i class="fa-solid fa-plus"></i> CREAR</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<!-- LOAD IMAGE-->
<script>
function previewImage(event, querySelector){
	//Recuperamos el input que desencadeno la acción
	const input = event.target;
	//Recuperamos la etiqueta img donde cargaremos la imagen
	$imgPreview = document.querySelector(querySelector);
	// Verificamos si existe una imagen seleccionada
	if(!input.files.length) return
	//Recuperamos el archivo subido
	file = input.files[0];
	//Creamos la url
	objectURL = URL.createObjectURL(file);
	//Modificamos el atributo src de la etiqueta img
    $imgPreview.src = objectURL;
    document.querySelector(querySelector);              
}
</script>
@endsection