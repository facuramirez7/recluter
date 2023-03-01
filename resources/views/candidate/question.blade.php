@extends('layouts.app')

@php
    use App\Models\Company;
    $company = Company::find($question->interview->company_id);
    $time_to_think = $question->interview->time_to_think;
    $time_to_reply = $question->interview->time_to_reply;
    $time = time();
@endphp

@section('title')
    <title>Entrevista</title>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/interview/style.css') }}">
    <script src="https://kit.fontawesome.com/e948f2dbbf.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        span {
            font-size: 25px;
        }

        #countdown,
        #countdown2 {
            font-size: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="container justify-content-center align-items-center">
        <div class="col-auto text-center">
            <h1>{{ $company->name }}<img src="/img/companies/{{ $company->photo }}" alt=""
                    style="max-height: 100px; border-radius: 100px;margin-left: 25px;"></h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (!isset($last))
                {{-- If is not the last question --}}
                <form action="{{ route('responder_pregunta') }}" method="POST" id="agregar-respuesta"
                    class="col-md-10 mx-auto" enctype='multipart/form-data'>
                    @csrf
                    <section id="" class="card-body">

                        <h4><b>{{ $question->question }}</b></h4>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="question_id" value="{{ $question->id }}">

                        @if ($question->video == 0)
                            <label for="answer">Respuesta</label>
                            <textarea disabled rows="1" placeholder="Ingrese su respuesta aquí, no exceda los 1000 caracteres.."
                                class="form-control autosize-input" style="height: 77px;" name="answer" idea id="answer"></textarea>
                            <span id="span">Piensa tu respuesta en: </span>
                            <br>
                            <span id="countdown"></span>
                            <span id="span2">Tienes tiempo hasta: </span>
                            <br>
                            <span id="countdown2"></span>
                        @else
                            <div>
                                <video autoplay="" id="stream-elem" controls width="600" style="border-radius: 10px;"
                                    height="400">
                                    <source src="" type="">
                                </video>
                            </div>
                            <span id="span">Prepárate! El video empezará en: </span>
                            <br>
                            <span id="countdown"></span>
                            <span id="span2">La grabación termina en: </span>
                            <br>
                            <span id="countdown2"></span>
                            <button type="button" class="d-none" id="start-stream">Empezar grabacion</button>
                            <button type="button" class="d-none" id="stop-media">Parar grabación</button>
                            <br>
                            <input type="hidden" name="answer" value="{{ $time }}">
                        @endif
                    @else
                        {{-- If is the last question --}}
                        <form action="{{ route('responder_pregunta.final') }}" method="POST" id="agregar-respuesta"
                            class="col-md-10 mx-auto" enctype='multipart/form-data'>
                            @csrf
                            <section id="" class="card-body">

                                <h4><b>{{ $question->question }}</b></h4>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="question_id" value="{{ $question->id }}">

                                @if ($question->video == 0)
                                    <label for="answer">Respuesta</label>
                                    <textarea disabled rows="1" placeholder="Ingrese su respuesta aquí, no exceda los 1000 caracteres.."
                                        class="form-control autosize-input" style="height: 77px;" name="answer" idea id="answer"></textarea>
                                    <span id="span">Piensa tu respuesta en: </span>
                                    <br>
                                    <span id="countdown"></span>
                                    <span id="span2">Tienes tiempo hasta: </span>
                                    <br>
                                    <span id="countdown2"></span>
                                @else
                                    <div>
                                        <video autoplay="" id="stream-elem" controls width="600"
                                            style="border-radius: 10px;" height="400">
                                            <source src="" type="">
                                        </video>
                                    </div>
                                    <span id="span">Prepárate! El video empezará en: </span>
                                    <br>
                                    <span id="countdown"></span>
                                    <span id="span2">La grabación termina en: </span>
                                    <br>
                                    <span id="countdown2"></span>
                                    <button type="button" class="d-none" id="start-stream">Empezar grabacion</button>
                                    <button type="button" class="d-none" id="stop-media">Parar grabación</button>
                                    <input type="hidden" name="answer" value="{{ $time }}">
                                    <br>
                                @endif
            @endif
            <button type="submit" id="next" class="btn btn-secondary mt-4 d-none">SIGUIENTE PREGUNTA <i
                    class="fa-solid fa-forward"></i></button>
            </section>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/apply/video.js') }}"></script>

    @if ($question->video == 0)
        {{-- SI LA RESPUESTA ¡NO! ES CON VIDEO SE EJECUTA ESTE SCRIPT --}}
        <script>
            window.onload = updateClock, $('#span2').hide();
            var totalTime = {{ $time_to_think }};

            function updateClock() {
                document.getElementById('countdown').innerHTML = totalTime;
                if (totalTime == 0) {
                    console.log('Empieza el conteo')
                    updateClock2()
                    totalTime = 1
                    $('#countdown').hide()
                    $('#span').hide();
                    $('#span2').show();
                    $("#answer").prop('disabled', false);
                } else {
                    totalTime -= 1;
                    setTimeout("updateClock()", 1000);
                }
            }
            //dividir por 6 a danger y por 3 a warning (colores del conteo)
            var totalTime2 = {{ $time_to_reply }};
            var warning = {{ $time_to_reply }} / 3;
            var danger = {{ $time_to_reply }} / 6;

            function updateClock2() {
                document.getElementById('countdown2').innerHTML = totalTime2;
                if (totalTime2 == 0) {
                    console.log('Empieza la respuesta.');
                    $("#next").trigger("click");
                } else if (totalTime2 == warning) {
                    totalTime2 -= 1;
                    setTimeout("updateClock2()", 1000);
                    $("#countdown2").addClass("text-warning");
                } else if (totalTime2 == danger) {
                    totalTime2 -= 1;
                    setTimeout("updateClock2()", 1000);
                    $("#countdown2").addClass("text-danger");
                } else {
                    totalTime2 -= 1;
                    setTimeout("updateClock2()", 1000);
                }
            }
        </script>
    @else
        {{-- SI LA RESPUESTA ES CON VIDEO SE EJECUTA ESTE SCRIPT --}}
        <script>
            var time = {{ $time }}
            window.CSRF_TOKEN = '{{ csrf_token() }}';
            window.onload = updateClock, $('#span2').hide();
            var totalTime = {{ $time_to_think }};

            function updateClock() {
                document.getElementById('countdown').innerHTML = totalTime;
                if (totalTime == 0) {
                    console.log('Prender camara!')
                    updateClock2()
                    totalTime = 1
                    $('#countdown').hide()
                    $('#span').hide();
                    $('#span2').show();
                    $("#start-stream").trigger("click");
                } else {
                    totalTime -= 1;
                    setTimeout("updateClock()", 1000);
                }
            }
            //dividir por 6 a danger y por 3 a warning (colores del conteo)
            var totalTime2 = {{ $time_to_reply }};
            var warning = {{ $time_to_reply }} / 3;
            var danger = {{ $time_to_reply }} / 6;

            function updateClock2() {
                document.getElementById('countdown2').innerHTML = totalTime2;
                if (totalTime2 == 0) {
                    console.log('Apagar camara');
                    videoElem.pause();
                    recorder.stop();

                    //wait(2000);
                    $("#next").trigger("click");
                } else if (totalTime2 == warning) {
                    totalTime2 -= 1;
                    setTimeout("updateClock2()", 1000);
                    $("#countdown2").addClass("text-warning");
                } else if (totalTime2 == danger) {
                    totalTime2 -= 1;
                    setTimeout("updateClock2()", 1000);
                    $("#countdown2").addClass("text-danger");
                } else {
                    totalTime2 -= 1;
                    setTimeout("updateClock2()", 1000);
                }
            }
        </script>
    @endif
@endsection
