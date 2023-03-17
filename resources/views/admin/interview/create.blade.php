@extends('layouts.admin.base')

@section('title')
    <title>Crear Entrevista</title>
@endsection

@section('pre-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
    <form action="{{ route('entrevistas.store') }}" method="POST" id="agregar-entrevista" class="col-md-10 mx-auto"
        enctype='multipart/form-data'>
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
        <label for="position">Nombre del puesto</label>
        <input name="position" id="position" type="text" class="form-control mb-4"
            placeholder="Introduzca el nombre del puesto para la entrevista.." required value="{{ old('position') }}">
        <label for="description">Descripción</label>
        <textarea rows="1" placeholder="Ingrese una descripción del puesto.." class="form-control autosize-input mb-4"
            style="height: 77px;" name="description" idea id="description" required></textarea>
        <div class="form-row">
            <div class="col-md-6">
                <label for="time_to_think">Tiempo para pensar la respuesta</label> <br>
                <select name="time_to_think" class="custom-select col-6 mb-4" id="">
                    <option value="5" selected>5 Segundos</option>
                    <option value="15">15 Segundos</option>
                    <option value="30">30 Segundos</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="time_to_reply">Tiempo para responder</label> <br>
                <select name="time_to_reply" class="custom-select col-6 mb-4 ml-2">
                    <option value="30" selected>30 Segundos</option>
                    <option value="60">60 Segundos</option>
                    <option value="120">120 Segundos</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        {{-- PREGUNTAS --}}
        <div data-tab-component>
            <ul class="tab-list">
                @for ($i = 0; $i < 5; $i++)
                    <li class="tab-item">
                        <a class="tab-link" href="#section-{{ $i }}">Pregunta {{ $i + 1 }}</a>
                    </li>
                @endfor
            </ul>
            {{-- por cada pregunta se crea un tab con su respecitvo input --}}
            @for ($i = 0; $i < 5; $i++)
                <section id="section-{{ $i }}" class="tab-panel mb-4">
                    <label for="question{{ $i }}">{{ $i + 1 }}° pregunta para la entrevista</label>
                    <input name="question[]" id="question{{ $i }}" type="text" class="form-control mb-4"
                        placeholder="Escriba la pregunta que quiere realizar.." required value="{{ old("question.$i") }}">
                    <label for="video[{{ $i }}]">Modo de respuesta </label>
                    <select name="video[]" class="custom-select col-2 ml-2">       
                        <option value="1" selected>Video</option> 
                        <option value="0" >Escrito</option>
                    </select>
                </section>
            @endfor
            <label for="goodbye">Mensaje de despedida</label>
            <input name="goodbye" id="goodbye" type="text" class="form-control mb-4"
                placeholder="Introduzca un mensaje de finalización.." required value="{{ old('goodbye') }}">
            <div class="form-group row justify-content-center">
                <button type="submit" class="btn btn-success mt-4" name="crear"><i class="fa-solid fa-plus"></i>
                    CREAR</button>
            </div>
    </form>
    </div>
@endsection

@section('pre-plugins')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/interview/tabs.js') }}"></script>
@endsection
