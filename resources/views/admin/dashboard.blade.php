@extends('layouts.admin.base')

@section('title')
    <title>Dashboard</title>
@endsection

@section('description')
    <meta name="description" content="Dashboard de Recluter">
@endsection

@section('content-title')
    Dashboard
@endsection

@section('content')
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="grid-menu grid-menu-2col">
                <div class="no-gutters row">
                    @if (Auth::user()->roles->pluck('name')->contains('Admin'))
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-primary"></div>
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="widget-numbers">{{ $users }}</div>
                                <div class="widget-subheading">Usuarios totales</div>
                                <div class="widget-description text-success">
                                    <i class="fa fa-angle-up"></i>
                                    <span class="pl-1">175.5%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-info"></div>
                                    <i class="fa-solid fa-shop"></i>
                                </div>
                                <div class="widget-numbers">{{ $companies }}</div>
                                <div class="widget-subheading">Empresas creadas</div>
                                <div class="widget-description text-info">
                                    <i class="fa fa-arrow-right"></i>
                                    <span class="pl-1">175.5%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-danger"></div>
                                    <i class="fa-solid fa-clipboard-question"></i>
                                </div>
                                <div class="widget-numbers">{{ $interviews }}</div>
                                <div class="widget-subheading">Cantidad de Entrevistas</div>
                                <div class="widget-description text-primary">
                                    <span class="pr-1">54.1%</span>
                                    <i class="fa fa-angle-up"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover br-br">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-success"></div>
                                    <i class="fa-solid fa-comment-dots"></i>
                                </div>
                                <div class="widget-numbers">{{ $answers }}</div>
                                <div class="widget-subheading">Respuestas Totales</div>
                                <div class="widget-description text-warning">
                                    <span class="pr-1">175.5%</span>
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-danger"></div>
                                    <i class="fa-solid fa-clipboard-question"></i>
                                </div>
                                <div class="widget-numbers">{{ $interviews }}</div>
                                <div class="widget-subheading">Cantidad de Entrevistas</div>
                                <div class="widget-description text-primary">
                                    <span class="pr-1">54.1%</span>
                                    <i class="fa fa-angle-up"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-info"></div>
                                    <i class="fa-solid fa-person-circle-check"></i>
                                </div>
                                <div class="widget-numbers">{{ $candidates }}</div>
                                <div class="widget-subheading">Candidatos totales</div>
                                <div class="widget-description text-info">
                                    <i class="fa fa-arrow-right"></i>
                                    <span class="pl-1">175.5%</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
