@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
@section('content_header')

@stop

@section('content')
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
                        <h1>Finca</h1>
                    </div>
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="fincas/create" class="btn btn-success">Nuevo Registro</a>
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
                            <th>NOMBRE ZONA</th>
                            <th>NOMBRE FINCA</th>
                            <th>CÉDULA</th>
                            <th>PROPIETARIO</th>
                            <th>TELÉFONO</th>
                            <th>COORDENADAS</th>
                            <th>VARIEDADES</th>
                            <th>DENSIDAD</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fincas as $finca)
                            <tr>
                                <td>{{ $count++ }}</td>
                                @foreach ($zonas as $zona)
                                    @if ($finca->idZona == $zona->id)
                                        <td>{{ $zona->nombreZona }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $finca->nombreFinca }}</td>
                                <td>{{ $finca->cedula }}</td>
                                <td>{{ $finca->propietarioFinca }}</td>
                                <td>{{ $finca->telefono}}</td>
                                <td>X:{{ $finca->coordenadaX }} Y:{{ $finca->coordenadaY }}</td>
                                <td>
                                    @foreach ($finca->variedades as $variedad)
                                       {{$variedad->descripcion}}<br>
                                    @endforeach
                                </td>
                                <td>{{ $finca->densidad}}</td>
                                <td>
                                    <form action="{{ route('fincas.destroy', $finca->id) }}" method="POST">
                                        <a href="{{route('fincas.edit', $finca->id)}}" class="btn btn-secondary"><i
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
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css">
@stop

@section('js')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"
        crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"
        crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatable-general.js')}}"></script>

@stop
