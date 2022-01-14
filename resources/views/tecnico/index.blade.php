@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
@section('content_header')

@stop

@section('content')
<!--Mensaje Creado -->
    @if (session('tecnicoGuardado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('tecnicoGuardado') }}
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
    <!--Mensaje Eliminado -->
    @if (session('tecnicoEliminado'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('tecnicoEliminado') }}
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
                        <h1>Técnico</h1>
                    </div>
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="tecnicos/create" class="btn btn-success">Nuevo Registro</a>
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
                            <th>NOMBRE TÉCNICO</th>
                            <th>INSTITUCIÓN</th>
                            <th>TELÉFONO</th>
                            <th>EMAIL</th>
                            <th>ACTIVO</th>
                            <th>ROL</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tecnicos as $tecnico)
                            @if($tecnico->fullacces == 'no' || $tecnico->fullacces == 'revisor')
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $tecnico->name }}</td>
                                <td>{{ $tecnico->institucion }}</td>
                                <td>{{ $tecnico->telefono }}</td>
                                <td>{{ $tecnico->email }}</td>
                                <td>{{ $tecnico->activo }}</td>
                                <td>@if($tecnico->fullacces == 'no')
                                    Técnico
                                    @else
                                    Revisor
                                @endif</td>
                                <td>
                                    <form action="{{ route('tecnicos.destroy', $tecnico->id) }}" method="POST">
                                        <a href="{{ route('tecnicos.edit',$tecnico->id) }}" class="btn btn-secondary"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Desea eliminar esto?')"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
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
        <script src="{{ asset('js/datatable-general.js')}}"></script>
@stop
