<div class="card">
    @section('title', 'Alertas Tempranas-Datos')
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <div class="justify-content-center">
        <div class="card-header align-items-center">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h1>Datos Totales</h1> <br>
                    <span>Mostrar</span>
                    <select class="mx-2 from-control">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="container col-md-2">
                    <div class="text-center justify-content-center">
                        <a href="{{ url('descargas/descarga-excel') }}" class="btn btn-success"><i
                                class="fas fa-file-excel"></i> EXCEL </a>
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
            {{$datos->links()}}
        </div>
    </div>
    {{-- @section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/datatable-general.js')}}"></script>

    @stop --}}
</div>