@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
@section('content_header')

@stop

@section('content')
    <!--Mensaje Creado -->
    @if (session('estudioGuardado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('estudioGuardado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje Modificado-->
    @if (session('estudioModificado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('estudioModificado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje Eliminado -->
    @if (session('estudioEliminado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('estudioEliminado') }}
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
                        <h1>Estudio</h1>
                    </div>
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="estudios/create" class="btn btn-success">Nuevo Registro</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="table"
                    class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap"
                    cellspacing="0" width="100%">
                    @php
                        $count=1;
                    @endphp
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ESTUDIO</th>
                            <th>FINCA</th>
                            <th>VARIEDAD</th>
                            <th>FENOLOGIA</th>
                            <th>DENSIDAD</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            <th>ACTIVO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudios as $estudio)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $estudio->nombreEstudio }}</td>
                                @foreach ($fvs as $fv)
                                    @if ($estudio->idFv == $fv->id)
                                        @foreach ($fincas as $finca)
                                            @if ($fv->finca_id == $finca->id)
                                                <td>{{ $finca->nombreFinca }}</td>
                                            @endif
                                        @endforeach
                                        @foreach ($variedades as $variedad)
                                            @if ($fv->variedad_id == $variedad->id)
                                                <td>{{ $variedad->descripcion }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <td>{{ $estudio->fenologia }}</td>
                                <td>{{ $estudio->densidad }}</td>
                                <td>{{ $estudio->fechaInicio }}</td>
                                <td>{{ $estudio->fechaFin }}</td>
                                <td>{{ $estudio->activo }}</td>
                                <td>
                                    <form action="{{ route('estudios.destroy', $estudio->id) }}" method="POST">
                                        <a href="{{route('estudios.edit', $estudio->id)}}" class="btn btn-secondary"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Desea eliminar esto?')"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
