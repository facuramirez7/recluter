@extends('layouts.admin.base')

@section('title')
    <title>
        Listado de Empresas</title>
@endsection

@section('description')
    <meta name="description" content="Listado de empresas">
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
    Empresas
@endsection

@section('content-subtitle')
    Listar
@endsection

@section('content')
    <div class="row justify-content-center">
        <a href="/empresas/create"> <button type="button" class="btn btn-success mb-3"> <i class="fas fa-plus"> </i> CREAR
                EMPRESA</button> </a>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="empresas" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        {{-- <th>Activo</th> --}}
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td> <img src="/img/companies/{{ $company->photo }}" width="50px"></td>
                            <td>{{ $company->name }} </td>
                            <td>{{ $company->description }}</td>
                            {{-- <td>
                                @if ($company->active == 0)
                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                @else
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                @endif
                            </td> --}}
                            <td>
                                <div class="row justify-content-center">
                                    <a class="mr-1" href="/empresas/{{ $company->id }}/edit"> <button type="button"
                                            class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="fas fa-edit"></i> </button></a>
                                    <form action="{{ route('empresas.destroy', $company->id) }}" method="POST"
                                        class="ml-1 formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                            data-placement="top" title="Eliminar"><i
                                                class="far fa-trash-alt"></i></i></button>
                                    </form>
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
            $('#empresas').DataTable({
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
                    "emptyTable": "No hay empresas",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ empresas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 empresas",
                    "infoFiltered": "(Filtrado de _MAX_ total empresas)",
                    "infoPostFix": "",
                    "thousands": ".",
                    "lengthMenu": "Mostrar _MENU_ empresas",
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
                            text: "No podrás revertir esta acción. Se eliminarán los usuarios, entrevistas y candidaturas de esta empresa.",
                            icon: 'warning',
                            iconColor: '#D92550',
                            confirmButtonText: 'Eliminar empresa',
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
                                    'La empresa se borró correctamente.',
                                    'success'
                                )
                            }
                        })

                    }, false)
                })
        })()
    </script>
@endsection
