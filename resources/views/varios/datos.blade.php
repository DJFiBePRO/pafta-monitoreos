@extends('adminlte::page')

@section('title', 'Ver Datos')

@section('content_header')
@stop
@section('content')
<div class="card">
    <div class="justify-content-center">
        <div class="card-header align-items-center">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h1>Datos Totales</h1>
                </div>
                <div class="container col-md-2">
                    <div class="text-center justify-content-center">
                     <a href="{{ url('descargas/descarga-excel') }}" class="btn btn-success"><i class="fas fa-file-excel"></i> EXCEL </a>
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
                        <th>PLANTA</th>
                        <th>FRUTO</th>
                        <th>INCIDENCIA</th>
                        <th>SEVERIDAD</th>
                        <th>FINCA</th>
                        <th>FECHA</th>
                        <th>CANTON</th>
                        <th>PARROQUIA</th>
                        <th>DENSIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                    {{-- @if (auth()->user()->fullacces == 'yes') --}}
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $dato->planta }}</td>
                        <td>{{ $dato->fruto }}</td>
                        <td>{{ $dato->incidencia }}</td>
                        <td>{{ $dato->severidad }}</td>
                        <td>{{ $dato->finca }}</td>
                        <td>{{ $dato->fecha}}</td>
                        <td>{{ $dato->canton }}</td>
                        <td>{{ $dato->parroquia }}</td>
                        <td>{{ $dato->densidad }}</td>
                    </tr>
                    {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('css')

@stop

@section('js')

@stop