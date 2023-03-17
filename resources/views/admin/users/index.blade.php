@extends('layouts.admin.base')

@section('title')
    <title>
        Listado de Usuarios</title>
@endsection

@section('description')
    <meta name="description" content="Listado de usuarios">
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
    Usuarios
@endsection

@section('content-subtitle')
    Listar
@endsection

@section('content')
    <div class="row justify-content-center">
        <a href="/usuarios/create"> <button type="button" class="btn btn-success mb-3"> <i class="fas fa-plus"> </i> CREAR
                USUARIO</button> </a>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="usuarios" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Email</th>
                        <th>Verificado</th>
                        <th>Empresa</th>
                        {{-- <th>Opciones</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} </td>
                            <td>{{ str_replace(['"', '[', ']'], '', $user->roles->pluck('name')) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->email_verified_at == null)
                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                @else
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                @endif
                            </td>
                            <td>
                                @if (isset($user->company->name))
                                    {{ $user->company->name }}
                                @else
                                    -
                                @endif
                            </td>
                            {{-- <td>
                        <div class="row justify-content-center">
                        <a class="mr-1" href="/usuarios/{{ $user->id}}/edit"> <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fas fa-edit"></i> </button></a>
                        <form  action="{{route('empresas.destroy',$user->id)}}" method="POST" class="ml-1 formDelete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></i></button>
                        </form> 
                        </div>
                        </td>  --}}
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
            $('#usuarios').DataTable({
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
                    "emptyTable": "No hay usuarios",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
                    "infoFiltered": "(Filtrado de _MAX_ total usuarios)",
                    "infoPostFix": "",
                    "thousands": ".",
                    "lengthMenu": "Mostrar _MENU_ usuarios",
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
                            confirmButtonText: 'Eliminar usuario',
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
                                    'El usuario se borró correctamente.',
                                    'success'
                                )
                            }
                        })

                    }, false)
                })
        })()
    </script>
@endsection
