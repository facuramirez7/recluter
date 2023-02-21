@extends('layouts.app')



@php
    use App\Models\Company;
    $company = Company::find($interview->company_id);
    $f = 1;
@endphp

@section('title')
<title>Entrevista</title>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/interview/style.css') }}">
<script src="https://kit.fontawesome.com/e948f2dbbf.js" crossorigin="anonymous"></script>
<style>
    *{
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
</style>
@endsection

@section('content-title')
{{$company->name}}
<img src="/img/companies/{{$company->photo}}" alt="" style="max-height: 100px; border-radius: 10px;">
@endsection

@section('content-subtitle')
{{$company->description}}
@endsection

@section('content')
<div class="container">
    <h1>{{$company->name}}<img src="/img/companies/{{$company->photo}}" alt="" style="max-height: 100px; border-radius: 30px;"></h1>
    <h2>{{$interview->position}}</h2>
    
    <h4>{{$interview->description}}</h4>


    <form action="{{route('entrevistas.store')}}" method="POST" id="agregar-entrevista" class="col-md-10 mx-auto" enctype='multipart/form-data'>
    @csrf
        <div data-tab-component class="mt-3">
            <ul class="tab-list">
                <li class="tab-item">
                    <a class="tab-link" href="#section-0">Datos básicos</a>
                </li>
                @for($i = 1; $i < 6; $i++)  
                    <li class="tab-item">
                        <a class="tab-link" href="#section-{{$i}}">Pregunta {{$i + 1}}</a>
                    </li>
                @endfor
            </ul>
            {{-- por cada pregunta se crea un tab con su respecitvo input --}}
            <section id="section-0" class="tab-panel">
                DATOS DEL CANDIDATO
            </section> 
            @foreach($interview->question as $question)             
                <section id="section-{{$f}}" class="tab-panel">
                <p><b>{{$question->question}}</b></p>   
                @if($question->video == 1)
                    AQUI VA EL VIDEO
                    Grabar Parar
                @else
                    <label for="question{{$f}}">Inserte la respuesta para la {{$f + 1}}° pregunta</label>
                    <input name="question[]" id="question{{$f}}" type="text" class="form-control mb-4" placeholder="Escriba la respuesta.." required value="{{ old("question.$f") }}"> 
                @endif
                </section> 
                @php $f++; @endphp
            @endforeach
            
            <div class="form-group row justify-content-center">
                <button type="submit" class="btn btn-success mt-4" style="width: 125px;" name="crear"><i class="fa-solid fa-plus"></i> GUARDAR</button>
            </div>      
            
        </div>
    </form>
</div>
{{-- @foreach($interview->question as $question)
    <p>{{$question->question}}</p>
    @if($question->video == 1)
        AQUI VA EL VIDEO
    @endif
    <br><br><br>
@endforeach --}}

<script type="text/javascript" src="{{ asset('js/interview/tabs.js') }}"></script>
@endsection