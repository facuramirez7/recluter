@extends('layouts.admin.base')

@section('title')
<title>Crear Entrevista</title>
@endsection

@section('pre-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/interview/style.css') }}">
@endsection

@section('description')
<meta name="description" content="Crear entrevista">
@endsection

@section('content-title')
Entrevista
@endsection

@section('content-subtitle')
Crear
@endsection

@section('content')

<form action="{{route('entrevistas.store')}}" method="POST" id="agregar-entrevista" class="col-md-10 mx-auto" enctype='multipart/form-data'>
    @csrf
    <label for="position">Nombre del puesto</label>
    <input name="position" id="position" type="text" class="form-control mb-4" placeholder="Introduzca el nombre del puesto para la entrevista.." required value="{{ old('position') }}">
    <label for="description">Descripión</label>
    <textarea rows="1" placeholder="Ingrese una descripción del puesto.."
        class="form-control autosize-input mb-4" style="height: 77px;" name="description" idea
        id="description" required></textarea>
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    {{-- PREGUNTAS --}}
    <div data-tab-component>
        <ul class="tab-list">
        @for($i = 0; $i < 5; $i++)  
        <li class="tab-item">
            <a class="tab-link" href="#section-{{$i}}">Pregunta {{$i + 1}}</a>
        </li>
        @endfor
        </ul>
        {{-- por cada pregunta se crea un tab con su respecitvo input --}}
        @for($i = 0; $i < 5; $i++)
            <section id="section-{{$i}}" class="tab-panel">
            <label for="question{{$i}}">{{$i + 1}}° pregunta para la entrevista</label>
            <input name="question[]" id="question{{$i}}" type="text" class="form-control mb-4" placeholder="Escriba la pregunta que quiere realizar.." required value="{{ old("question.$i") }}"> 
            <label for="question{{$i}}">¿La respuesta precisa de video?  </label>
            <input type="checkbox" value="0" name="video[{{$i}}]">
            </section>
        @endfor
        <div class="form-group row justify-content-center">
            <button type="submit" class="btn btn-success" name="crear"><i class="fa-solid fa-plus"></i> CREAR</button>
        </div>
    </form>
  </div>
@endsection

@section('pre-plugins')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/interview/tabs.js') }}"></script>
@endsection