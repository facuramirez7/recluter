@extends('layouts.admin.base')

@section('title')
    <title>Listado de Candidatos</title>
@endsection

@section('description')
    <meta name="description" content="Listado de candidatos">
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
    Candidatos
@endsection

@section('content-subtitle')
    Listar
@endsection

@section('content')
    @php
        use App\Models\Interview;
    @endphp
    <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="candidatos" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        @if (auth()->user()->roles->pluck('name')->contains('Admin'))
                            <th>Empresa</th>
                        @else
                        @endif
                        <th>Posición</th>
                        <th>Respuestas</th>
                        <th>Ver Respuestas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->surname }} </td>
                            <td>{{ $user->name }} </td>
                            <td>{{ $user->email }}</td>
                            @if (auth()->user()->roles->pluck('name')->contains('Admin'))
                                @if (isset($user->company->name))
                                <td>{{ $user->company->name }}</td>
                                @else
                                <td>-</td>
                                @endif
                            @else
                            @endif
                            <td>
                                @foreach ($user->question_answereds as $answer)
                                    <?php
                                    $interview = Interview::find($answer->question->interview_id);
                                    continue;
                                    ?>    
                                @endforeach
                                @if(isset($interview))
                                    {{ $interview->position }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ count($user->question_answereds) }}</td>
                            <td>
                                <div class="row justify-content-center">
                                    @if( count($user->question_answereds) != 0)
                                        <a class="mr-1" href="/candidatura/{{ $user->id }}/{{ $interview->id }}"> <button type="button"
                                                class="btn btn-warning" data-toggle="tooltip" data-placement="top"
                                                title="Visualizar"> <i class="fa-solid fa-eye"></i> </button></a>
                                    @else
                                        <a class="mr-1" href="/candidatos"> <button type="button"
                                                class="btn btn-warning" data-toggle="tooltip" data-placement="top"
                                                title="Visualizar" disabled> <i class="fa-solid fa-eye"></i> </button></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
            $('#candidatos').DataTable({
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
                    "emptyTable": "No hay candidatos",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ candidatos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 candidatos",
                    "infoFiltered": "(Filtrado de _MAX_ total candidatos)",
                    "infoPostFix": "",
                    "thousands": ".",
                    "lengthMenu": "Mostrar _MENU_ candidatos",
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
    {{-- SWEET ALERT --}}
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.formDelete')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        event.stopPropagation()

                        Swal.fire({
                            title: '¿Estás segur@?',
                            text: "No podrás revertir esta acción",
                            icon: 'warning',
                            iconColor: '#D92550',
                            confirmButtonText: 'Eliminar candidato',
                            showCancelButton: true,
                            confirmButtonColor: '#D92550',
                            cancelButtonColor: 'grey',
                            cancelButtonText: 'Cancelar',
                            showCloseButton: 'true',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire(
                                    'Eliminado',
                                    'El candidato se borró correctamente.',
                                    'success'
                                )
                            }
                        })

                    }, false)
                })
        })()
    </script>
@endsection
