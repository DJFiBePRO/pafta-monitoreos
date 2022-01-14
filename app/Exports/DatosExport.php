<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use App\Models\Estudio;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DatosExport implements WithStyles, WithMultipleSheets
{
    use Exportable;



    /**
     * @return \Illuminate\Support\Collection
     */
    // public function array(): array
    // {
    //     $datos = DB::table('monitoreos')
    //     ->join('estudios', 'estudios.id', '=', 'monitoreos.idEstudio')
    //     ->join('datos', 'monitoreos.id', '=', 'datos.idMonitoreo')
    //     ->join('finca_variedad', 'estudios.idFv', '=', 'finca_variedad.id')
    //     ->join('fincas', 'finca_variedad.finca_id', '=', "fincas.id")
    //     ->join('variedads','finca_variedad.variedad_id','=','variedads.id')
    //     ->join('plantas','datos.idPlanta', '=', 'plantas.id')
    //     ->join('zonas','fincas.idZona', '=','zonas.id')
    //     ->join('parroquias','zonas.idParroquia','=','parroquias.id')
    //     ->join('cantons','parroquias.idCanton','=','cantons.id')
    //     ->select('plantas.codigo as planta','datos.fruto as fruto','datos.incidencia as incidencia','datos.severidad as severidad','fincas.nombreFinca as finca','monitoreos.fechaEjecucion as fecha','fincas.densidad as densidad','cantons.nombre as canton','parroquias.nombre as parroquia','variedads.descripcion as variedad', 'monitoreos.estado')
    //     ->get()
    //     ->toArray();
    //     //return Dato::query()->whereYear('created_at', $this->year);
    //     // $data=[];
    //     $datos_array[]=array('PLANTA','FRUTO','INCIDENCIA','SEVERIDAD','FINCA','FECHA','CANTON','PARROQUIA','DENSIDAD');
    //     foreach ($datos as $dato) {
    //         $datos_array[]=array(
    //             'PLANTA'=>$dato->planta,
    //             'FRUTO'=>$dato->fruto,
    //             'INCIDENCIA'=>$dato->incidencia,
    //             'SEVERIDAD'=>$dato->severidad,
    //             'FINCA'=>$dato->finca,
    //             'FECHA'=>$dato->fecha,
    //             'CANTON'=>$dato->canton,
    //             'PARROQUIA'=>$dato->parroquia,
    //             'DENSIDAD'=>$dato->densidad
    //         );
    //     }
    //     return $datos_array;
    // }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function sheets(): array
    {
        $estudios = Estudio::all();
        $contador = 1;
        $datos_totales=[];
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
                ->select('estudios.id as estudio','plantas.codigo as planta', 'datos.fruto as fruto', 'datos.incidencia as incidencia', 'datos.severidad as severidad', 'fincas.nombreFinca as finca', 'monitoreos.fechaEjecucion as fecha', 'fincas.densidad as densidad', 'cantons.nombre as canton', 'parroquias.nombre as parroquia', 'variedads.descripcion as variedad', 'monitoreos.estado')
                ->get()
                ->toArray();
        $sheets = [];

        foreach ($estudios as $estudio) {
            $datos_array[] = array('PLANTA', 'FRUTO', 'INCIDENCIA', 'SEVERIDAD', 'FINCA', 'FECHA', 'CANTON', 'PARROQUIA', 'DENSIDAD');
            foreach ($datos as $dato) {
                if($estudio->id ==$dato->estudio)
                {
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
                $datos_totales[] = array(
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
            $sheets[] = new DatosPorEstudio($datos_array, 'CAMPO ' . $contador++);
            $datos_array=null;
        }
        $sheets[] = new DatosPorEstudio($datos_totales, 'CONSOLIDADO');

        return $sheets;
    }
}
