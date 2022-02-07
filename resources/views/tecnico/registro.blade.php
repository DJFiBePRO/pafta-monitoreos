@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png" />
@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card">
            @csrf
            <!--Mensaje Creado -->
            @if (session('tecnicoGuardado'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('tecnicoGuardado') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('datoGuardado'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('datoGuardado') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!--Mensaje Modificado-->
            @if (session('tecnicoModificado'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('tecnicoModificado') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('datoModificado'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('datoModificado') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!--Mensaje Eliminado -->
            @if (session('tecnicoEliminado'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('tecnicoEliminado') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <div class="justify-content-center">
                    <div class="card-header align-items-center">
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                @can('1')
                                    <h1>Monitoreos a Registrar</h1>
                                @endcan
                                @can('2')
                                    <h1>Sus Monitoreos</h1>
                                @endcan
                                @can('3')
                                    <h1>Revisión Monitoreos </h1>
                                @endcan
                            </div>
                            <div class="container col-md-2">
                                <div class="text-center justify-content-center">

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
                            @endphp
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>MONITOREO</th>
                                    <th>ESTUDIO</th>
                                    @can('1')
                                        <th>TECNICO</th>
                                    @endcan
                                    @can('3')
                                        <th>TECNICO</th>
                                    @endcan
                                    <th>FINCA</th>
                                    <th>CANTON</th>
                                    <th>PARROQUIA</th>
                                    <th>FECHA PLANIFICADA</th>
                                    <th>OBSERVACIONES</th>
                                    <th>EJECUTADO</th>
                                    @can('1')
                                        <th>ACCIÓN</th>
                                    @endcan
                                    @can('2')
                                        <th>ACCIÓN</th>
                                    @endcan

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendientes as $monitoreo)
                                    @if (auth()->user()->fullacces == 'yes')
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $monitoreo->codigoMonitoreo }}</td>
                                            <td>{{ $monitoreo->codigo }} - {{ $monitoreo->nombreEstudio }}</td>
                                            <td>{{ $monitoreo->name }}</td>
                                            <td>{{ $monitoreo->nombreFinca }}</td>
                                            <td>{{ $monitoreo->cantonNombre }}</td>
                                            <td>{{ $monitoreo->parroquiaNombre }}</td>
                                            <td>{{ $monitoreo->fechaPlanificada }}</td>
                                            <td>{{ $monitoreo->observaciones }}</td>
                                            <td>
                                                @if ($monitoreo->estado == 'si')
                                                    <i class="fas fa-user-check bg-success"></i> {{ $monitoreo->estado }}
                                                @else
                                                    <i class="fas fa-exclamation-triangle bg-danger"></i>
                                                    {{ $monitoreo->estado }}
                                            </td>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($monitoreo->estado == 'no')
                                            <a href="{{url( '/dato',$monitoreo->id) }}"
                                                class="btn btn-primary" onClick="this.disabled='disabled'">Ir <i
                                                    class="far fa-arrow-alt-circle-right">
                                                </i> </a>
                                        @else
                                            Completo <a href="{{ url('/completo', [$monitoreo->id]) }}"
                                                class="btn btn-primary"><i class="far fa-list-alt"></i></a>
                                            <a href="{{ url('dato/modificar', [$monitoreo->id]) }}"
                                                class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        @endif
                                    </td>
                                    </tr>
                                @elseif(auth()->user()->id == $monitoreo->idTecnico && auth()->user()->fullacces == 'no')
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $monitoreo->codigoMonitoreo }}</td>
                                        <td>{{ $monitoreo->codigo }} - {{ $monitoreo->nombreEstudio }}</td>
                                        <td>{{ $monitoreo->nombreFinca }}</td>
                                        <td>{{ $monitoreo->cantonNombre }}</td>
                                        <td>{{ $monitoreo->parroquiaNombre }}</td>
                                        <td>{{ $monitoreo->fechaPlanificada }}</td>
                                        <td>{{ $monitoreo->observaciones }}</td>
                                        <td>
                                            @if ($monitoreo->estado == 'si')
                                                <i class="fas fa-user-check bg-success"></i> {{ $monitoreo->estado }}
                                                
                                            @else
                                                <i class="fas fa-exclamation-triangle bg-danger"></i>
                                                {{ $monitoreo->estado }}
                                        </td>
                                @endif
                                <td>
                                    @if ($monitoreo->estado == 'no')
                                        <a href="{{url( '/dato',$monitoreo->id) }}"
                                            class="btn btn-primary" onClick="this.disabled='disabled'">Ir <i
                                                class="far fa-arrow-alt-circle-right">
                                            </i> </a>
                                    @else
                                        Completo <a href="{{ url('/completo', [$monitoreo->id]) }}"
                                            class="btn btn-primary"><i class="far fa-list-alt"></i></a>
                                    @endif
                                </td>
                                </tr>
                                @endif
                                @if (auth()->user()->fullacces == 'revisor')
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $monitoreo->codigoMonitoreo }}</td>
                                        <td>{{ $monitoreo->codigo }} - {{ $monitoreo->nombreEstudio }}</td>
                                        <td>{{ $monitoreo->name }}</td>
                                        <td>{{ $monitoreo->nombreFinca }}</td>
                                        <td>{{ $monitoreo->cantonNombre }}</td>
                                        <td>{{ $monitoreo->parroquiaNombre }}</td>
                                        <td>{{ $monitoreo->fechaPlanificada }}</td>
                                        <td>{{ $monitoreo->observaciones }}</td>
                                        <td>
                                            @if ($monitoreo->estado == 'si')
                                                <i class="fas fa-user-check bg-success"></i> {{ $monitoreo->estado }}
                                                Completo <a href="{{ url('/completo', [$monitoreo->id]) }}"
                                                    class="btn btn-primary"><i class="far fa-list-alt"></i></a>
                                            @else
                                                <i class="fas fa-exclamation-triangle bg-danger"></i>
                                                {{ $monitoreo->estado }}

                                        </td>
                                @endif
                                </td>
                                </tr>
                                @endif
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
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('js/datatable-general.js')}}"></script>
@stop
