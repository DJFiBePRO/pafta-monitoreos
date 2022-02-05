<?php

namespace App\Http\Livewire\Varios;

use App\Models\Variedad;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Exports\DatosExport;
use Maatwebsite\Excel\Facades\Excel;


class Datos extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // private $pagination = 5;
    public $cant=10;// ayuada a pagunar en el inner join
    public $sort='numeracion';//trae el id
    public $direction='asc';//se usa en la consulta inner join

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        /*$data=DB::table('users')
        ->join()*/

        $datos = DB::table('monitoreos')
        ->join('estudios', 'estudios.id', '=', 'monitoreos.idEstudio')
        ->join('datos', 'monitoreos.id', '=', 'datos.idMonitoreo')
        ->join('finca_variedad', 'estudios.idFv', '=', 'finca_variedad.id')
        ->join('fincas', 'finca_variedad.finca_id', '=', "fincas.id")
        ->join('variedads','finca_variedad.variedad_id','=','variedads.id')
        ->join('plantas','datos.idPlanta', '=', 'plantas.id')
        ->join('zonas','fincas.idZona', '=','zonas.id')
        ->join('parroquias','zonas.idParroquia','=','parroquias.id')
        ->join('cantons','parroquias.idCanton','=','cantons.id')
        ->select(DB::raw('row_number() over() numeracion'),'plantas.codigo as planta', 'datos.fruto as fruto', 'datos.incidencia as incidencia', 'datos.severidad as severidad', 'fincas.nombreFinca as finca', 'monitoreos.fechaEjecucion as fecha', 'variedads.descripcion as genotipo', 'cantons.nombre as canton', 'parroquias.nombre as parroquia', 'fincas.densidad as densidad')
        //->where('monitoreos.idTecnico',$id)
        //->where('monitoreos.estado',$si)
        // ->orderBy('numeracion')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->cant);//Ya funciona xD


        return view('livewire.varios.datos', compact('datos'))
        ->extends('adminlte::page');
    }
    // public function vista($id)
    // {
    //     $si='si';
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
    //     //->where('monitoreos.idTecnico',$id)
    //     //->where('monitoreos.estado',$si)
        
    //     ->get();//Ya funciona xD
    //     return view('livewire.varios.datos',compact('datos'))->extends('adminlte::page');;
    // }

    public function exportExcel()
    {
        return Excel::download( new DatosExport, 'datos.xlsx' );
    }
    
    public function order($sort){
        if ($this->sort==$sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->sort=$sort; 
            $this->direction = 'asc';
        }
        
    }
}
