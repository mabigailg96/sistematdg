<?php

namespace App\Http\Controllers;

use App\RequestExtension;
use Illuminate\Http\Request;
use \DB;
use App\Tdg;
use Carbon\Carbon;

class RequestExtensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tipo_solicitud,$id)
    {
        //
      
        
        $tdg = Tdg::find($id);
    
        $ciclo = DB::table('semesters')->find($tdg->ciclo_id);
        //Rescatar el ciclo del tdg que esta en curso.
        $ciclo_id = $tdg->students()->where('tdg_id', $tdg->id)->first()->pivot->ciclo_id;
        $ciclo = DB::table('semesters')->find($ciclo_id);
        
        $fecha = new Carbon($ciclo->fechaInicio);
       
       if($tipo_solicitud=='prorroga')
        {
            $fechaInicioProrroga = ($fecha->copy()->addMonths(9))->subDays(1);
            $fechaFinProrroga = $fechaInicioProrroga->copy()->addMonths(6);
            
                return view('requests.prorroga')->with('tdgs', $tdg)->with('fechaInicio', $fechaInicioProrroga->format('d/m/Y'))->with('fechaFin', $fechaFinProrroga->format('d/m/Y'))->with('tipo',1);
        
        
            }
        else if ($tipo_solicitud=='extension_de_prorroga')
        {
            //Rescatamos la solicitud de prorroga aprobada para rescatar la fecha de finalizacion de esa prorroga.
            $prorroga = $tdg->request_extensions()->where('aprobado',1)->where('type_extension_id',1)->first();
            
            $fecha = new Carbon($prorroga->fecha_fin);

            $fechaInicioProrroga = $fecha;
            //A la fecha de finalizacion se le suman los 6 meses y resta un dia
            $fechaFinProrroga = $fecha->copy()->addMonths(6)->subDays(1); 
        return view('requests.prorroga')->with('tdgs', $tdg)->with('fechaInicio', $fechaInicioProrroga->format('d/m/Y'))->with('fechaFin', $fechaFinProrroga->format('d/m/Y'))->with('tipo',2);
        
    
    }

        else if ($tipo_solicitud=='prorroga_especial')
        {
            return view('requests.prorroga_especial')->with('tdgs', $tdg); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_extension = $request->validate([
            'justificacion' => 'required',
        ]);

        $tipo = $request['tipo'];
        $fechaInicio = $request['fecha_inicio'];
        $fechaFin = $request['fecha_fin'];
        
        $guardado =0;

          if($tipo==1)
        {    
            $extension_1 = RequestExtension::create([
                'fecha' => date("y-m-d"),
                'fecha_inicio' => new Carbon($fechaInicio),
                'fecha_fin' => new Carbon($fechaFin),
                'justificacion'=> $request_extension['justificacion'],
                'tdg_id' => $request['tdg_id'],
                'type_extension_id'=>'1',
            ]);
            //Retornamos el mensaje y a la vista de listado
            return redirect()->route('solicitudes.listar','&save=1&tipo=Prorroga');
       
        }
        else if ($tipo==2)
        {
            $extension_2 = RequestExtension::create([
                'fecha' => date("y-m-d"),
                'fecha_inicio' => new Carbon($fechaInicio),
                'fecha_fin' => new Carbon($fechaFin),
                'justificacion'=> $request_extension['justificacion'],
                'tdg_id' => $request['tdg_id'],
                'type_extension_id'=>'2',
            ]);
            //Retornamos el mensaje y a la vista de listado
            return redirect()->route('solicitudes.listar','&save=1&tipo=Extension de prorroga');
       
           
        }
        else if ($tipo_solicitud=='prorroga_especial')
        {
           //Les dejo la especial xd
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function show(RequestExtension $requestExtension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestExtension $requestExtension)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestExtension $requestExtension)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestExtension $requestExtension)
    {
        //
    }
}
