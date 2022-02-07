<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\Estudio;
use App\Models\Monitoreo;
use App\Models\Planta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $datos = DB::table('datos')
        ->join('monitoreos','datos.idMonitoreo', '=','monitoreos.id')
        ->join('plantas','datos.idPlanta', '=','plantas.id')
        ->join('estudios','monitoreos.idEstudio', '=','estudios.id')
        ->select('datos.id','monitoreos.codigo as codigoMonitoreo','estudios.codigo as codigoEstudio','estudios.nombreEstudio','plantas.codigo as codigoPlanta','datos.fruto','datos.incidencia','datos.severidad','monitoreos.observaciones','monitoreos.idTecnico')
        ->get();
        //return dd($datos);
        return view('dato.index', compact('datos'));
    }
    public function vista()
    {
        //
        $tecnicos = DB::table('monitoreos')
        ->join('estudios','monitoreos.idEstudio', '=','estudios.id')
        ->select('monitoreos.idTecnico','estudios.id as idEstudio','estudios.codigo','estudios.nombreEstudio')
        ->distinct()
        ->get();
        $datos = DB::table('datos')
        ->join('monitoreos','datos.idMonitoreo', '=','monitoreos.id')
        ->join('plantas','datos.idPlanta', '=','plantas.id')
        ->join('estudios','monitoreos.idEstudio', '=','estudios.id')
        ->select('datos.id','monitoreos.codigo as codigoMonitoreo','estudios.codigo as codigoEstudio','estudios.nombreEstudio','plantas.codigo as codigoPlanta','datos.fruto','datos.incidencia','datos.severidad','monitoreos.observaciones','monitoreos.idTecnico')
        ->get();
        $estudios= Estudio::all();
        // return dd($estudios);
        return view('dato.vista', compact('datos','tecnicos','estudios'));
    }

    

    public function registro()
    {
        //
        $datos['datos'] = Dato::all();
        $datos['monitoreos'] = Monitoreo::all();
        $datos['plantas'] = Planta::all();

        return view('dato.registro', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $datos['datos'] = Dato::all();
        $datos['monitoreos'] = Monitoreo::all();
        $datos['plantas'] = Planta::all();
        $datos['estudios'] = Estudio::all();
        return view('dato.create', $datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datos = request()->except('_token');
        Dato::insert($datos);

        return redirect('/datos')->with('datoGuardado', 'Dato guardado con éxito');
    }

    public function guardar(Request $request)
    {
        $idMonitoreo = $request->idMonitoreo;
        $idPlanta = $request->idPlanta;
        $fruto = $request->fruto;
        $incidencia = $request->incidencia;
        $severidad = $request->severidad;
        $observaciones=$request->observaciones;
        $e=$request->estado;
        for ($i = 0; $i < count($idMonitoreo); $i++) {
            $datasave = [
                'idMonitoreo' => $idMonitoreo[$i],
                'idPlanta' => $idPlanta[$i],
                'fruto' => $fruto[$i],
                'incidencia' => $incidencia[$i],
                'severidad' => $severidad[$i],
            ];
            DB::table('datos')->insert($datasave);
        }
        $ob=$observaciones;
        Monitoreo::where('id',$idMonitoreo)->update(['observaciones'=>$ob,'estado'=>$e]);
        //return dd($i);
        return redirect('/tecnico')->with('datoGuardado', 'Dato guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function show(Dato $dato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dato = Dato::findorFail($id);
        $monitoreos = Monitoreo::all();
        $plantas = Planta::all();
        return view('dato.edit', compact('dato', 'monitoreos', 'plantas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datos = request()->except(['_token', '_method']);
        Dato::where('id', '=', $id)->update($datos);
        return redirect('/datos')->with('datoModificado', 'Dato modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Dato::destroy($id);
        return back()->with('datoEliminado', 'Dato eliminado con éxito');
    }

    public function pendientes($idMonitoreo)
    {
        //
        $monitoreo = Monitoreo::findorFail($idMonitoreo);
        $plantas = DB::table('plantas')
            ->join('monitoreos', 'plantas.idEstudio', '=', "monitoreos.idEstudio")
            ->select('plantas.*')
            ->where('monitoreos.id', $idMonitoreo)
            ->orderBy('codigo','ASC')
            ->get();
        return view('dato.registro', compact('plantas', 'monitoreo'));
    }
    public function completo($idMonitoreo){
        $monitoreo = Monitoreo::findorFail($idMonitoreo);
        $datos = DB::table('datos')
            ->join('monitoreos', 'monitoreos.id', '=', "datos.idMonitoreo")
            ->join('plantas', 'plantas.id', '=', "datos.idPlanta")
            ->select('datos.*','plantas.codigo')
            ->where('datos.idMonitoreo', $idMonitoreo)
            ->orderBy('codigo','ASC')
            ->get();
            //return dd($datos);
        return view('dato.completo', compact('datos','monitoreo'));
    }
    public function modificar($idMonitoreo){
        $monitoreo = Monitoreo::findorFail($idMonitoreo);
        $datos = DB::table('datos')
            ->join('monitoreos', 'monitoreos.id', '=', "datos.idMonitoreo")
            ->join('plantas', 'plantas.id', '=', "datos.idPlanta")
            ->select('datos.*','plantas.codigo')
            ->where('datos.idMonitoreo', $idMonitoreo)
            ->orderBy('codigo','ASC')
            ->get();
            //return dd($datos);
        return view('dato.modificarDatos', compact('datos','monitoreo'));
    }
    public function actualizar(Request $request)
    {
        $idMonitoreo = $request->idMonitoreo;
        $idPlanta = $request->idPlanta;
        $fruto = $request->fruto;
        $incidencia = $request->incidencia;
        $severidad = $request->severidad;
        $observaciones=$request->observaciones;
        $e=$request->estado;
        for ($i = 0; $i < count($idMonitoreo); $i++) {
            $datasave = [
                'idMonitoreo' => $idMonitoreo[$i],
                'idPlanta' => $idPlanta[$i],
                'fruto' => $fruto[$i],
                'incidencia' => $incidencia[$i],
                'severidad' => $severidad[$i],
            ];
            DB::table('datos')->insert($datasave);
        }
        $ob=$observaciones;
        Monitoreo::where('id',$idMonitoreo)->update(['observaciones'=>$ob,'estado'=>$e]);
        //return dd($i);
        return redirect('/tecnico')->with('datoModificado', 'Datos modificados con éxito');
    }
}
