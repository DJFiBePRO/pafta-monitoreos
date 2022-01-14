<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;

class DatosPorEstudio implements FromArray, WithTitle
{
    private $titulo;
    protected $datos_totales;

    public function __construct($datos_totales=null, string $titulo)
    {
        $this->datos_totales = $datos_totales;
        $this->titulo=$titulo;
    }

    /**
     * @return Builder
     */

    public function array(): array
    {
        $datos_array[] = array('PLANTA', 'FRUTO', 'INCIDENCIA', 'SEVERIDAD', 'FINCA', 'FECHA', 'CANTON', 'PARROQUIA', 'DENSIDAD');
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
            ->select('plantas.codigo as planta', 'datos.fruto as fruto', 'datos.incidencia as incidencia', 'datos.severidad as severidad', 'fincas.nombreFinca as finca', 'monitoreos.fechaEjecucion as fecha', 'fincas.densidad as densidad', 'cantons.nombre as canton', 'parroquias.nombre as parroquia', 'variedads.descripcion as variedad', 'monitoreos.estado')
            ->get()
            ->toArray();
        foreach ($datos as $dato) {
            $datos_array[] = array(
                'PLANTA' => $dato->planta,
                'FRUTO' => $dato->fruto,
                'INCIDENCIA' => $dato->incidencia,
                'SEVERIDAD' => $dato->severidad,
                'FINCA' => $dato->finca,
                'FECHA' => $dato->fecha,
                'CANTON' => $dato->canton,
                'PARROQUIA' => $dato->parroquia,
                'DENSIDAD' => $dato->densidad
            );
        }
        return $this->datos_totales ?: $datos_array;
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return $this->titulo;
    }
}
