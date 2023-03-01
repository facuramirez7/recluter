@extends('layouts.app')

@php
    use App\Models\Company;
    $company = Company::find($interview->company_id);
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

        .R {
            height: 28px;
        }
    </style>
@endsection

@section('content')
    <div class="container justify-content-center align-items-center">
        <div class="col-auto text-center">
            <div class="card bg-light mb-3 ">
                <div class="card-header">{{ $company->name }}</div>
                <div class="card-body">
                    Puesto:<h5 class="card-title"> {{ $interview->position }}</h5>
                    <p class="card-text">{{ $interview->goodbye }}</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endsection
