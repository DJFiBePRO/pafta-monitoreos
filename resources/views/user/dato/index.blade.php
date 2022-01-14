@extends('layouts.base')
@section('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css">
@endsection

@section('contenido')
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
                        <h1>Datos</h1>
                    </div>
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="datos/create" class="btn btn-success">Nuevo Registro</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table"
                    class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MONITOREO</th>
                            <th>PLANTA</th>
                            <th>FRUTO</th>
                            <th>INCIDENCIA (%)</th>
                            <th>SEVERIDAD (%)</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                            <tr>
                                <td>{{ $dato->id }}</td>
                                @foreach ($monitoreos as $monitoreo)
                                    @if ($dato->idMonitoreo== $monitoreo->id)
                                        <td>{{ $monitoreo->codigo }}</td>
                                    @endif
                                @endforeach
                                @foreach ($plantas as $planta)
                                    @if ($dato->idPlanta== $planta->id)
                                        <td>{{ $planta->codigo }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $dato->fruto }}</td>
                                <td>{{ $dato->incidencia }}</td>
                                <td>{{ $dato->severidad }}</td>
                                <td>
                                        <a href="/datos/{{ $dato->id }}/edit" class="btn btn-secondary"><i
                                                class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatable-general.js')}}"></script>
@endsection
@endsection
