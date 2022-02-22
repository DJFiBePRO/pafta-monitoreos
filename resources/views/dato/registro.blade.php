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
                    <div class="container col-md-2">
                        <div class="text-center justify-content-center">
                            <a href="{{url('tecnico')}}" class="btn btn-danger btn-block "><i
                                    class="far fa-arrow-alt-circle-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>

            <form class="needs-validation" action="{{url('/dato/guardar')}}" method="POST" novalidate>
                @csrf
                @php
                    $contadorLineas = 0;
                @endphp
                @php
                    $contadorFilas = 0;
                @endphp
                <div class="container"><br>
                    <Label>Observaciones:</Label>
                    <input class="form-control" type="text" name="observaciones" placeholder="Ingrese Observaciones"
                        value="{{ isset($monitoreo->observaciones) ? $monitoreo->observaciones : '' }}">
                    <input type="hidden" name="estado" value="si">
                    <table
                        class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap">
                        <thead>
                            <br>
                            <tr>
                                <th>Planta</th>
                                <th>Frutos</th>
                                <th>Incidencia </th>
                                <th>Severidad (%)</th>
                                {{-- <th>Acción</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plantas as $planta)
                                @for ($i = 1; $i <= 10; $i++)
                                    <tr
                                        class="@if ($contadorLineas % 2 == 0) table-success
                            @else
                                table-warning @endif">
                                        <input class="form-control" type="hidden" name="idMonitoreo[]" tabindex="-1"
                                            value="{{ $monitoreo->id }}">
                                        <input class="form-control" type="hidden" name="idPlanta[]" tabindex="-1"
                                            value="{{ $planta->id }}">
                                        <td><input readonly value="{{ $planta->codigo }}" class="form-control text" tabindex="-1"
                                                name="" id=""></td>
                                        <td><input readonly value="{{ $i }}" class="form-control text" tabindex="-1"
                                                name="fruto[]" id=""></td>
                                        <td><input type="text" class="form-control" name="incidencia[]" tabindex="-1"
                                                id="spTotal-{{ $contadorFilas }}" value="" readonly>
                                        </td>
                                        <td><input id="borra-{{ $contadorFilas }}" value="" min="0" max="100" minlength="1" maxlength="3"
                                                onkeypress="return soloNum(event);"
                                                onchange="sumar(this.value,{{ $contadorFilas }});"
                                                tabindex="{{ $contadorFilas+1 }}" class="form-control text"
                                                name="severidad[]" id="" required>
                                        </td>

                                        {{-- <td><button type="button" class="btn btn-primary" id="remove" ><i
                                                    class="far fa-times-circle" tabindex="-1" ></i></button></td> --}}
                                    </tr>
                                    @php
                                        $contadorFilas = $contadorFilas + 1;
                                    @endphp
                                @endfor
                                @php
                                    $contadorLineas = $contadorLineas + 1;
                                @endphp

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="container col-md-2">
                    <button class="btn btn-primary btn-block" tabindex="{{ $contadorFilas+1 }}" @if ($contadorLineas == 0) disabled @endif><i class="far fa-save" > </i>
                        Guardar</button>
                </div>
                <br>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        function sumar(valor, codigoId) {
            var total = 0;
            valor = parseInt(valor); // Convertir el valor a un entero (número).

            total = document.getElementById('spTotal-' + codigoId).value;

            // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
            total = (total == null || total == undefined || total == "") ? 0 : total;

            /* Esta es el calculo severidad. */
            total = (parseInt(valor));
            if (total > 0 && total <= 100) {
                document.getElementById('spTotal-' + codigoId).value = 1;
            } else if(total == 0) {
                // Colocar el resultado en el control "input".
                document.getElementById('spTotal-' + codigoId).value = total;
            } else if (total == -1) {
                // Colocar el resultado en el control "input".
                document.getElementById('spTotal-' + codigoId).value = 'No existe fruto';
            } else{
                //Alerta que informa ingreso del rango de numeros
                alert("Ingresar solo números entre el rango de -1 a 100");
                document.getElementById('borra-' + codigoId).value = '';
            }
        }

        function soloNum(ev) {
            if (window.event) {
                keynum = ev.keyCode;
            } else {
                keynum = ev.which;
            }
            if ((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 45) {
                return true;
            } else {
                alert("Ingresar solo números");
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#remove', function() {
            $(this).closest('tr').remove();
        });
    </script>
@stop
