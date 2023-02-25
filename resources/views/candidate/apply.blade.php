@extends('layouts.app')

@php
    use App\Models\Company;
    $company = Company::find($interview->company_id);
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
    .R{
        height: 28px;
    }

</style>
@endsection

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none modal-btn" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/logo/R.png') }}" class="R" alt="R"></h5>
        </div>
        <div class="modal-body">
            Hola! Bienvenido al proceso de selección de <b>{{$company->name}}</b> para el puesto de <b>{{$interview->position}}</b>.
            El proceso consiste en un par de preguntas que deberás responder de forma verbal dentro del tiempo
            determinado, también podremos solicitarte alguna respuesta por escrito o la realización de algún test.
            
            El proceso es muy intuitivo y no durará más de 10 minutos, es necesario que dejes activado la cámara y
            
            micrófono en todo el proceso, y que tengas tu CV en PDF (te pediremos que lo cargues).
            
            Una vez iniciado el proceso al hacer clic en Comenzar, no podrás iniciar nuevamente.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Comenzar <i class="fa-solid fa-hourglass-start"></i></button>
        </div>
      </div>
    </div>
  </div>
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
    <form action="{{route('aplicar.store.user')}}" method="POST" id="agregar-user" class="col-md-10 mx-auto" enctype='multipart/form-data'>
    @csrf
            {{-- Datos básicos del Candidato --}}
            <section id="" class="card-body">
                <p><b>DATOS DEL CANDIDATO</b></p> 
                <label for="name">Nombre</label>
                <input name="name" id="name" type="text" class="form-control mb-4" placeholder="Nombre.." required value="{{ old("name") }}">
                
                <label for="surname">Apellido</label>
                <input name="surname" id="surname" type="text" class="form-control mb-4" placeholder="Apellido.." required value="{{ old("surname") }}">

                <label for="email">Email</label>
                <input name="email" id="email" type="email" class="form-control mb-4" placeholder="Email.." required value="{{ old("email") }}">
                
                <label for="country">País</label>
                <input name="country" id="country" type="text" class="form-control mb-4" placeholder="Lugar de Residencia.." required value="{{ old("country") }}"> 

                <label for="date_of_birth">Fecha de Nacimiento</label>
                <input name="date_of_birth" id="date_of_birth" type="date" class="form-control mb-4" placeholder="Fecha de Nacimiento.." value="{{ old("date_of_birth") }}"> 

                <input type="hidden" name="interview_id" value="{{$interview->id}}">
                
                <button type="submit" class="btn btn-secondary">SIGUIENTE <i class="fa-solid fa-forward"></i></button>
            </section>                 
    </form>

    <p><b>Puesto:</b></p>
    <p>{{$interview->position}}</p>
    <p><b>Descrpición:</b></p>
    <p>{{$interview->description}}</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
window.onload = function() {
    $(".modal-btn").trigger("click");
};
</script>
@endsection