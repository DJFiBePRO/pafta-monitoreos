@extends('layouts.base')

@section('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css">
@endsection

@section('contenido')
    <!--Mensaje Creado -->
    @if (session('fincaGuardado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('fincaGuardado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje Modificado-->
    @if (session('fincaModificado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('fincaModificado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje Eliminado -->
    @if (session('fincaEliminado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('fincaEliminado') }}
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
                        <h1>Monitoreo</h1>
                    </div>
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="monitoreos/create" class="btn btn-success">Nuevo Registro</a>
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
                            <th>CODIGO</th>
                            <th>ESTUDIO</th>
                            <th>FECHA PLANIFICADA</th>
                            <th>FECHA DE EJECUCION</th>
                            <th>OBSERVACIONES</th>
                            <th>ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monitoreos as $monitoreo)
                            <tr>
                                <td>{{ $monitoreo->codigo }}</td>
                                @foreach ($estudios as $estudio)
                                    @if ($monitoreo->idEstudio == $estudio->id)
                                        <td>{{ $estudio->codigo }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $monitoreo->fechaPlanificada }}</td>
                                <td>{{ $monitoreo->fechaEjecucion }}</td>
                                <td>{{ $monitoreo->observaciones }}</td>
                                <td>
                                    <a href="/monitoreos/{{ $monitoreo->id }}/edit" class="btn btn-secondary"><i
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
