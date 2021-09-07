@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
@section('content_header')

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Nuevo Registro</h1>
        </div>
        <div class="card-body">
        <form class="needs-validation" action="{{ route('datos.store') }}" method="POST" novalidate>
        @csrf
            @include('dato.form')
        </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type = "text/javascript" >
            $(document).ready(function() {
                $('#idMonitoreo').on('change', function() {
                    $.ajax({
                        url: "{{ route('admin.plantas.bymonitoreo') }}?idMonitoreo=" + $(this).val(),
                        method: 'GET',
                        success: function(data) {
                            $('#plantas').html(data.html);
                        }
                    });
                });
            });
    </script>
@stop
