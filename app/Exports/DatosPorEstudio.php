<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DatosPorEstudio implements FromArray, WithTitle,WithStyles,ShouldAutoSize
{
    private $titulo;
    protected $datos_totales;

    public function __construct($datos_totales = null, string $titulo)
    {
        $this->datos_totales = $datos_totales;
        $this->titulo = $titulo;
    }

    /**
     * @return Builder
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'size' => 12]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'F'  => 45,
            // 'G'  => 45,
            // 'H'  => 45,
            // 'I'  => 45,
        ];
    }

    public function array(): array
    {
        if ($this->datos_totales == null) {
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
                ->get()
                ->toArray();
            array_unshift($datos, $datos_array);
        }
        return $this->datos_totales ?: $datos;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->titulo;
    }
}
