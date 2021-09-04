@extends('adminlte::page')

@section('title', 'Alertas Tempranas')

@section('content_header')

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Nuevo Registro</h1>
        </div>
        <div class="card-body">
            <form class="needs-validation" action="/estudios" method="POST" novalidate>
                @csrf
                @include('estudio.form')
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#idFinca').on('change', function() {
                $.ajax({
                    url: "{{ route('admin.variedades.byfinca') }}?idFinca=" + $(this).val(),
                    method: 'GET',
                    success: function(result) {
                        console.log(result);
                        var dbSelect = $('#idVariedad');
                        dbSelect.empty();
                        for (var i = 0; i < result.length; i++) {
                            dbSelect.append($('<option/>', {
                                value: result[i].id,
                                text: result[i].descripcion
                            }));
                        }
                        //$('#variedades').html(data.html);
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {
            $('select').each(function() {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                    closeOnSelect: !$(this).attr('multiple'),
                    language: "es",
                });
            });
        });
    </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#fechaFin").change(function() {
                    var startDate = document.getElementById("fechaInicio").value;
                    var endDate = document.getElementById("fechaFin").value;

                    if ((Date.parse(startDate) >= Date.parse(endDate))) {
                        alert("La fecha de fin debe ser mayor que la fecha de inicio");
                        document.getElementById("fechaFin").value = "";
                    }
                });
            });
        </script>
@stop
