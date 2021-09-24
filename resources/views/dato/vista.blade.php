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
                @php
                    $idEstudioSelect = 0;
                @endphp
                @if (auth()->user()->fullacces == 'yes')
                    <select id="idPlanta" class="form-control" name="idPlanta" required>
                        <option value="0" @php
                            $idEstudioSelect = 0;
                        @endphp>Todos</option>
                        @foreach ($estudios as $estudio)
                            <option value="{{ isset($estudio->id) ? $estudio->id : '' }}@php
                                $idEstudioSelect = $estudio->id;
                            @endphp">
                                {{ $estudio->codigo }} - {{ $estudio->nombreEstudio }}</option>
                        @endforeach
                    </select>
                @else
                    <select id="idPlanta" class="form-control" name="idPlanta" required>
                        <option value="0" @php
                            $idEstudioSelect = 0;
                        @endphp>Todos</option>
                        @foreach ($tecnicos as $tecnico)
                            @if (auth()->user()->id == $tecnico->idTecnico)
                                <option
                                    value="{{ isset($tecnico->idEstudio) ? $tecnico->idEstudio : '' }}@php
                                        $idEstudioSelect = $tecnico->idEstudio;
                                    @endphp">
                                    {{ $tecnico->codigo }} - {{ $tecnico->nombreEstudio }}</option>
                            @endif
                        @endforeach
                    </select>
                @endif
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
    <script>
        $(document).ready(function() {
            $("#table").DataTable({
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %d fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "1": "Mostrar 1 fila",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmentemente"
                    },
                    "decimal": ",",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "conditions": {
                            "date": {
                                "after": "Despues",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "notBetween": "No entre",
                                "notEmpty": "No Vacio",
                                "not": "Diferente de"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacio",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual que",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío",
                                "not": "Diferente de"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina en",
                                "equals": "Igual a",
                                "notEmpty": "No Vacio",
                                "startsWith": "Empieza con",
                                "not": "Diferente de"
                            },
                            "array": {
                                "not": "Diferente de",
                                "equals": "Igual",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "notEmpty": "No Vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d"
                    },
                    "select": {
                        "1": "%d fila seleccionada",
                        "_": "%d filas seleccionadas",
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "$d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "am",
                            "pm"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                        }
                    },
                    "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
                },
                "lengthMenu": [
                    [5, 10, 50, 100, -1],
                    [5, 10, 50, 100, "Todos"]
                ],
                responsive: true
            });
        });
    </script>
@stop