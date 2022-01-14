<div class="card">
    @section('title', 'Ver Datos')
    <div class="justify-content-center">
        <div class="card-header align-items-center">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h1>Técnico</h1>
                </div>
                <div class="container col-md-2">
                    <div class="text-center justify-content-center">
                        {{-- <a href="tecnicos/create" class="btn btn-success">Nuevo Registro</a> --}}
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
                        <th>NOMBRE TÉCNICO</th>
                        <th>INSTITUCIÓN</th>
                        <th>TELÉFONO</th>
                        <th>EMAIL</th>
                        <th>ACTIVO</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tecnicos as $tecnico)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $tecnico->name }}</td>
                        <td>{{ $tecnico->institucion }}</td>
                        <td>{{ $tecnico->telefono }}</td>
                        <td>{{ $tecnico->email }}</td>
                        <td>{{ $tecnico->activo }}</td>
                        <td><a href="/patfa-monitoreos/public/descarga/{{ $tecnico->id }}" class="btn btn-primary"
                               >Ir <i class="far fa-arrow-alt-circle-right">
                                </i> </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tecnicos->links() }}
        </div>
    </div>
</div>