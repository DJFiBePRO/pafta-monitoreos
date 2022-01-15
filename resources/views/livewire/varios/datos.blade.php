<div class="card">
    @section('title', 'Alertas Tempranas-Datos')
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <div class="justify-content-center">
        <div class="card-header align-items-center">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h1>Datos Totales</h1>
                </div>
                <div class="container col-md-2">
                    <div class="text-center justify-content-center">
                        <a href="{{ url('descarga/descarga-excel') }}" class="btn btn-success"><i
                                class="fas fa-file-excel"></i> EXCEL </a>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 form-row">
                    <label class="row "><span style="font-weight:normal" class="col">Mostrar</span>
                        <select wire:model="cant" name="table_length" aria-controls="table"
                            class="custom-select custom-select-sm form-control form-control-sm col">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="-1">Todos</option>
                        </select>
                        <span style="font-weight:normal" class="col">registros</span></label>
                </div>
                <div class="col-sm-12 col-md-6"></div>
            </div>

            <div class="table-responsive">
                <table id="table"
                class="table table-striped table-hover table-bordered table-sm bg-white shadow-lg display nowrap"
                cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th class="cursor-pointer" wire:click="order('numeracion')"># @if ($sort == 'numeracion')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                        <th class="cursor-pointer" wire:click="order('planta')">PLANTA @if ($sort == 'planta')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                        <th class="cursor-pointer" wire:click="order('fruto')">FRUTO @if ($sort == 'fruto')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                        <th class="cursor-pointer" wire:click="order('incidencia')">INCIDENCIA @if ($sort == 'incidencia')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif
                        </th>
                        <th class="cursor-pointer" wire:click="order('severidad')">SEVERIDAD @if ($sort == 'severidad')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif
                        </th>
                        <th class="cursor-pointer" wire:click="order('finca')">FINCA @if ($sort == 'finca')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                        <th class="cursor-pointer" wire:click="order('fecha')">FECHA @if ($sort == 'fecha')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                        <th class="cursor-pointer" wire:click="order('canton')">CANTON @if ($sort == 'canton')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                        <th class="cursor-pointer" wire:click="order('parroquia')">PARROQUIA @if ($sort == 'parroquia')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif
                        </th>
                        <th class="cursor-pointer" wire:click="order('densidad')">DENSIDAD @if ($sort == 'densidad')@if ($direction == 'asc') <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>@else<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>@endif @else<i class="fas fa-sort float-right mt-1"></i>@endif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                        {{-- @if (auth()->user()->fullacces == 'yes') --}}
                        <tr>
                            <td>{{ $dato->numeracion }}</td>
                            <td>{{ $dato->planta }}</td>
                            <td>{{ $dato->fruto }}</td>
                            <td>{{ $dato->incidencia }}</td>
                            <td>{{ $dato->severidad }}</td>
                            <td>{{ $dato->finca }}</td>
                            <td>{{ $dato->fecha }}</td>
                            <td>{{ $dato->canton }}</td>
                            <td>{{ $dato->parroquia }}</td>
                            <td>{{ $dato->densidad }}</td>
                        </tr>
                        {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>
            {{ $datos->links() }}
            </div>
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
