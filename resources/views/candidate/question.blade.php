@extends('layouts.app')

@php
    use App\Models\Company;
    $company = Company::find($question->interview->company_id);
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

@section('content')
<div class="container">
    <h1>{{$company->name}}<img src="/img/companies/{{$company->photo}}" alt="" style="max-height: 100px; border-radius: 100px;margin-left: 25px;"></h1> 
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif 
    <form action="" method="POST" id="agregar-user" class="col-md-10 mx-auto" enctype='multipart/form-data'>
    @csrf
            {{-- Datos básicos del Candidato --}}
            <section id="" class="card-body">
                
                <h4><b>{{$question->question}}</b></h4> 
                
                @if($question->video == 0)
                    <label for="answer">Respuesta</label>             
                    <textarea rows="1" placeholder="Ingrese una descripción del producto..."
                    class="form-control autosize-input" style="height: 77px;" name="asnwer" idea
                    id="asnwer">Inserte una respuesta con no más de 1000 caracteres.</textarea>
                @else                
                <video autoplay="" id="stream-elem" controls width="600" height="400">
                    <source src="" type=""  >
                </video>   <br>   
                <button type="button" id="start-stream" class="btn btn-success"><i class="fa-solid fa-circle-play"></i></button>
                <button type="button" id="stop-media" class="btn btn-danger"><i class="fa-solid fa-circle-stop"></i></button>   
                <br>         
                @endif            
                <button type="submit" class="btn btn-secondary mt-4">SIGUIENTE PREGUNTA <i class="fa-solid fa-forward"></i></button>
            </section>                 
    </form>
</div>
{{-- @foreach($interview->question as $question)
    <p>{{$question->question}}</p>
    @if($question->video == 1)
        AQUI VA EL VIDEO
    @endif
    <br><br><br>
@endforeach --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/apply/video.js') }}"></script>
@endsection