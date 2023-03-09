@extends('layouts.admin.base')

@section('title')
    <title>Listado de Respuestas</title>
@endsection

@section('description')
    <meta name="description" content="Listado de respuestas">
@endsection

@section('pre-css')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
@endsection

@section('content-title')
    {{ $user->name }}
@endsection

@section('content-subtitle')
    {{ $user->email }}
@endsection

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @foreach ($answereds as $answer)
                @if ($answer->question->video == 0)
                    <p class="mb-2"><b>{{ $answer->question->question }}</b></p>
                    <p class="mb-4">{{ $answer->answer }}</p>
                @else
                    <p class="mb-2"><b>{{ $answer->question->question }}</b></p>
                    <video id="stream-elem" controls width="600" style="border-radius: 10px;"
                        height="400" class="mb-4">
                        <source src="{{asset('video/answer/'.$answer->answer)}}" type="video/webm">
                    </video>
                @endif
            @endforeach
            </tbody>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- TABLE --}}
    <script>
        $(document).ready(function() {
            $('#candidaturas').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "Todas"]
                ],
                "order": [
                    [0, "desc"]
                ],
                language: {
                    "decimal": ",",
                    "emptyTable": "No hay candidaturas",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ candidaturas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 candidaturas",
                    "infoFiltered": "(Filtrado de _MAX_ total candidaturas)",
                    "infoPostFix": "",
                    "thousands": ".",
                    "lengthMenu": "Mostrar _MENU_ candidaturas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/interview/link.js') }}"></script>
@endsection
