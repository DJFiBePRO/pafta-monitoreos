@extends('adminlte::page')

@section('title', "Reporte Monitoreo {$monitoreo->fechaPlanificada}")
<link rel="shortcut icon" type="image/png" href="img/favicon.png" />

@section('content_header')
@stop

@section('content')
    <!--Mensaje Creado -->
    @if (session('datoGuardado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('datoGuardado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje Modificado-->
    @if (session('datoModificado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('datoModificado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje Eliminado -->
    @if (session('datoEliminado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('datoEliminado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="justify-content-center">
            <div class="card-header align-items-center">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h1>Revisión de Datos</h1>
                    </div>
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="/patfa-monitoreos/public/tecnico" class="btn btn-danger btn-block "><i
                                    class="far fa-arrow-alt-circle-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table"
                    class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap"
                    cellspacing="0" width="100%">
                    @php
                        $count = 1;
                        $pinta = 0;
                    @endphp
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PLANTA</th>
                            <th>FRUTO</th>
                            <th>INCIDENCIA</th>
                            <th>SEVERIDAD (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $codigoPlanta = '';
                        @endphp
                        @foreach ($datos as $dato)
                            @if ($codigoPlanta != $dato->idPlanta)
                                @php
                                $pinta=$pinta+1;
                                @endphp
                            @endif
                            <tr
                                class="@if ($pinta % 2 != 0) table-success
                            @else
                                table-warning @endif">
                                <td>{{ $count++ }}</td>
                                <td>{{ $dato->codigo }}</td>
                                <td>{{ $dato->fruto }}</td>
                                <td>{{ $dato->incidencia }}</td>
                                <td>{{ $dato->severidad }}</td>
                            </tr>
                            @php
                                $codigoPlanta = $dato->idPlanta;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css">
@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('js/datatable-general.js')}}"></script>
@stop
