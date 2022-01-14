@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
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
                        <h1>Datos</h1>
                    </div>
                    @can('1')
                        <div class="container col-md-2">
                            <div class="text-center justify-content-center">
                                <a href="datos/create" class="btn btn-success">Nuevo Registro</a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table"
                    class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap"
                    cellspacing="0" width="100%">
                    @php
                        $count = 1;
                        $estudioId = 0;
                    @endphp
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>MONITOREO</th>
                            <th>ESTUDIO</th>
                            <th>PLANTA</th>
                            <th>FRUTO</th>
                            <th>INCIDENCIA</th>
                            <th>SEVERIDAD (%)</th>
                            <th>OBSERVACIONES</th>
                            @can('1')
                                <th>ACCIONES</th>
                            @endcan
                            @can('2')
                                <th>ACCIONES</th>
                            @endcan


                        </tr>
                    </thead>
                    <tbody>
                        @if (auth()->user()->fullacces == 'yes')
                            @foreach ($datos as $dato)
                                <tr>
                                    <td>{{ $count++ }}</td>


                                    <td>{{ $dato->codigoMonitoreo }}</td>
                                    <td>{{ $dato->codigoEstudio }}- {{ $dato->nombreEstudio }}</td>
                                    <td>{{ $dato->codigoPlanta }}</td>

                                    <td>{{ $dato->fruto }}</td>
                                    <td>{{ $dato->incidencia }}</td>
                                    <td>{{ $dato->severidad }}</td>

                                    <td>{{ $dato->observaciones }}</td>

                                    @can('1')
                                        <td>

                                            <form action="{{ route('datos.destroy', $dato->id) }}" method="POST">
                                                <a href="{{ route('datos.edit', $dato->id) }}" class="btn btn-secondary"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Desea eliminar esto?')"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>

                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        @else
                            @foreach ($datos as $dato)
                                @if (auth()->user()->id == $dato->idTecnico)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $dato->codigoMonitoreo }}</td>
                                        <td>{{ $dato->codigoEstudio }} - {{ $dato->nombreEstudio }}</td>

                                        <td>{{ $dato->codigoPlanta }}</td>

                                        <td>{{ $dato->fruto }}</td>
                                        <td>{{ $dato->incidencia }}</td>
                                        <td>{{ $dato->severidad }}</td>

                                        <td>{{ $dato->observaciones }}</td>

                                        @can('2')
                                            <td>
                                                <a href="{{ route('datos.edit', $dato->id) }}" class="btn btn-secondary"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                            </td>
                                        @endcan
                                    </tr>
                                @endif
                            @endforeach
                        @endif
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
        <script src="{{ asset('js/datatable-general.js')}}"></script>
@stop
