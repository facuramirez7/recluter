@extends('layouts.admin.base')

@section('title')
    <title>Entrevista</title>
@endsection

@section('description')
    <meta name="description" content="Entrevista">
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
    Entrevista
@endsection

@section('content-subtitle')
    Cuestionario
@endsection

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Pregunta</th>
                        <th scope="col">¿Con video?</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        //dd($interview);
                        $i = 1;
                    @endphp
                    @foreach ($interview->question as $question)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $question->question }}</td>
                            @if ($question->video == 1)
                                <td>Sí</td>
                            @else
                                <td>No</td>
                            @endif
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
