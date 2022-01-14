<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use App\Models\Estudio;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DatosExport implements WithMultipleSheets
{
    use Exportable;



    /**
     * @return \Illuminate\Support\Collection
     */

    public function sheets(): array
    {
        $estudios = Estudio::all();
        $contador = 1;

        $sheets = [];

        foreach ($estudios as $estudio) {
            $datos_array[] = array('PLANTA', 'FRUTO', 'INCIDENCIA', 'SEVERIDAD', 'FINCA', 'FECHA', 'GENOTIPO', 'CANTON', 'PARROQUIA', 'DENSIDAD');
            $datos = DB::table('monitoreos')
                ->join('estudios', 'estudios.id', '=', 'monitoreos.idEstudio')
                ->join('datos', 'monitoreos.id', '=', 'datos.idMonitoreo')
                ->join('finca_variedad', 'estudios.idFv', '=', 'finca_variedad.id')
                ->join('fincas', 'finca_variedad.finca_id', '=', "fincas.id")
                ->join('variedads', 'finca_variedad.variedad_id', '=', 'variedads.id')
                ->join('plantas', 'datos.idPlanta', '=', 'plantas.id')
                ->join('zonas', 'fincas.idZona', '=', 'zonas.id')
                ->join('parroquias', 'zonas.idParroquia', '=', 'parroquias.id')
                ->join('cantons', 'parroquias.idCanton', '=', 'cantons.id')
                ->select('plantas.codigo as planta', 'datos.fruto as fruto', 'datos.incidencia as incidencia', 'datos.severidad as severidad', 'fincas.nombreFinca as finca', 'monitoreos.fechaEjecucion as fecha', 'variedads.descripcion as genotipo', 'cantons.nombre as canton', 'parroquias.nombre as parroquia', 'fincas.densidad as densidad')
                ->where('estudios.id', $estudio->id)
                ->get()
                ->toArray();
            array_unshift($datos,$datos_array);
            $sheets[] = new DatosPorEstudio($datos, 'CAMPO ' . $contador++);
            $datos_array = null;
        }
        $sheets[] = new DatosPorEstudio(null, 'CONSOLIDADO');

        return $sheets;

    }
}
