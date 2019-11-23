<?php

namespace App\Http\Controllers;

use App\RequestExtension;
use Illuminate\Http\Request;
use \DB;
use App\Tdg;
use Carbon\Carbon;
use App\TypeExtension;

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
        $fechaMostrarInicio = new Carbon();
        $fechaMostrarFin = new Carbon();
        
        $tdg = Tdg::find($id);
    
        //$ciclo = DB::table('semesters')->find($tdg->ciclo_id);
        //Rescatar el ciclo del tdg que esta en curso.
        $ciclo_id = $tdg->students()->where('tdg_id', $tdg->id)->first()->pivot->ciclo_id;
        $ciclo = DB::table('semesters')->find($ciclo_id);
        
        $fecha_ciclo = new Carbon($ciclo->fechaInicio);
      
       if($tipo_solicitud=='prorroga')
        {
            $monthExtension = TypeExtension::where('tipo', 'Prórroga')->get();
            foreach($monthExtension as $month){
                $prorroga = $month;
            }

            $finalizacion  = TypeExtension::where('tipo', 'Finalización')->get();
            foreach($finalizacion as $fin){
                $mesesFin = $fin;
            }
            

            $fechaInicioProrroga = ($fecha_ciclo->copy()->addMonths($mesesFin->meses));
            $fechaFinProrroga = $fechaInicioProrroga->copy()->addMonths($prorroga->meses)->subDays(1);
          
            
                return view('requests.prorroga')->with('tdgs', $tdg)->with('fechaInicio', $fechaInicioProrroga->format('d/m/Y'))->with('fechaFin', $fechaFinProrroga->format('d/m/Y'))->with('tipo',1);
        
            }
        else if ($tipo_solicitud=='extension_de_prorroga')
        {
            //Rescatamos la solicitud de prorroga aprobada para rescatar la fecha de finalizacion de esa prorroga.
            $prorroga = $tdg->request_extensions()->where('aprobado',1)->where('type_extension_id',1)->first();

            $monthExtension = TypeExtension::where('tipo', 'Extension de prórroga')->get();
            foreach($monthExtension as $month){
                $prorrogaExtension = $month;
            }
            
           
            $fecha = new Carbon($prorroga->fecha_fin);

            $fechaInicioProrroga = $fecha->copy()->addDays(1);
            //A la fecha de finalizacion se le suman los 3 meses y resta un dia
            $fechaFinProrroga = $fecha->copy()->addMonths($prorrogaExtension->meses); 
        return view('requests.extension_prorroga')->with('tdgs', $tdg)->with('fechaInicio', $fechaInicioProrroga->format('d/m/Y'))->with('fechaFin', $fechaFinProrroga->format('d/m/Y'))->with('tipo',2);
        
    
    }

        else if ($tipo_solicitud=='prorroga_especial')
        {
            $prorroga_especial = $tdg->request_extensions()->where('aprobado',1)->where('type_extension_id',3)->orderby('created_at','DESC')->take(1)->get();
            if($prorroga_especial->isEmpty()){
                $extension_prorroga = $tdg->request_extensions()->where('aprobado',1)->where('type_extension_id',2)->first();
           
            $fecha = new Carbon($extension_prorroga->fecha_fin);
            $fechaInicioExtensionProrroga = $fecha->copy()->addDays(1);
            }else{
                
                foreach ($prorroga_especial as $especial => $prorroga) {
                    # code...
                    $especial_anterior = $prorroga;
                }
                $fecha = new Carbon($especial_anterior->fecha_fin);
                $fechaInicioExtensionProrroga = $fecha->copy()->addDays(1);
                //dd($fecha_ciclo, $fechaInicioExtensionProrroga);
                
                //Esto lo estoy haciendo para validad que las prorrogas especiales no pasen de 3 anos, validando con la fecha inicio del ciclo y la fecha final de la ultima prorroga
                $diff = $fecha_ciclo->diffInMonths($fechaInicioExtensionProrroga);

                //Evaluando la cantidad de meses para saber si puede pedir o no la prórroga
                if($diff<36){
                    $fecha = new Carbon($especial_anterior->fecha_fin);
                    $fechaInicioExtensionProrroga = $fecha->copy()->addDays(1);
                    return view('requests.prorroga_especial')->with('tdgs', $tdg)->with('fechaInicio', $fechaInicioExtensionProrroga->format('d/m/Y'))->with('tipo',3);

                }else if($diff>=36)
                {
                    return redirect()->route('solicitudes.listar','&save=0');
                }
            }
            //Rescatamos solicitud de extension de prorroga para obtener la fecha en la que termina.
           

            return view('requests.prorroga_especial')->with('tdgs', $tdg)->with('fechaInicio', $fechaInicioExtensionProrroga->format('d/m/Y'))->with('tipo',3);
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
                'fecha' => Carbon::now(),
                'fecha_inicio' => (new Carbon($fechaInicio))->format('y-d-m'),
                'fecha_fin' => (new Carbon($fechaFin))->format('y-d-m'),
                'justificacion'=> $request_extension['justificacion'],
                'tdg_id' => $request['tdg_id'],
                'type_extension_id'=>'1',
            ]);
            //Retornamos el mensaje y a la vista de listado
            return redirect()->route('solicitudes.listar','&save=1&tipo=Prórroga');
       
        }
        else if ($tipo==2)
        {
            $request_extension = $request->validate([
                'justificacion' => 'required',
                'url_documento_solicitud'=>'required|unique:request_extensions',
            ]);

            $file = $request->file('url_documento_solicitud');

            //obtenemos el nombre del archivo
            $nombrearchivo = $file->getClientOriginalName();

            $compnombre = RequestExtension::all();

            //metodo que comprueba si el nombre del acuerdo
            $nom = 0;
            if ($compnombre)
            {
                foreach ($compnombre as $existe)
                {
                    if ($existe->url_documento_solicitud == $nombrearchivo)
                    $nom = 1;
                }
            }

            if ($nom == 0)
            {
                \Storage::disk('localexpro')->put($nombrearchivo,  \File::get($file));

                $fechaInicioExtension =  Carbon::createFromFormat('d/m/Y',$fechaInicio);
                $fechaFinExtension =  Carbon::createFromFormat('d/m/Y',$fechaFin);
                $extension_2 = RequestExtension::create([
                    'fecha' => date("y-m-d"),
                    'fecha_inicio' => $fechaInicioExtension,
                    'fecha_fin' => $fechaFinExtension,
                    'justificacion'=> $request_extension['justificacion'],
                    'url_documento_solicitud' => $nombrearchivo,
                    'tdg_id' => $request['tdg_id'],
                    'type_extension_id'=>'2',
                ]);
                //Retornamos el mensaje y a la vista de listado
                return redirect()->route('solicitudes.listar','&save=1&tipo=Extensión de prórroga');
            } else {
                return redirect()->route('request_extension.ingresar', ['tipo_solicitud' => 'extension_de_prorroga', 'id' => $request['tdg_id'], 'save' => 0])
                ->with('error','El nombre del archivo de la solicitud ya existe. Por favor cambie el nombre del archivo');
            }
       
           
        }
        else if ($tipo==3)
        {
            $request_extension = $request->validate([
                'justificacion' => 'required',
                'url_documento_solicitud'=>'required|unique:request_extensions',
            ]);

            $file = $request->file('url_documento_solicitud');

            //obtenemos el nombre del archivo
            $nombrearchivo = $file->getClientOriginalName();

            $compnombre = RequestExtension::all();

            //metodo que comprueba si el nombre del acuerdo
            $nom = 0;
            if ($compnombre)
            {
                foreach ($compnombre as $existe)
                {
                    if ($existe->url_documento_solicitud == $nombrearchivo)
                    $nom = 1;
                }
            }

            if ($nom == 0)
            {
                \Storage::disk('localproes')->put($nombrearchivo,  \File::get($file));

                $meses = $fechaFin;
                $fechaInicioEspecial =  Carbon::createFromFormat('d/m/Y',$fechaInicio);
                
                $fechaFinEspecial = $fechaInicioEspecial->copy()->addMonths($meses)->subDays(1);
                $extension_2 = RequestExtension::create([
                    'fecha' => date("y-m-d"),
                    'fecha_inicio' => $fechaInicioEspecial,
                    'fecha_fin' => $fechaFinEspecial,
                    'justificacion'=> $request_extension['justificacion'],
                    'url_documento_solicitud' => $nombrearchivo,
                    'tdg_id' => $request['tdg_id'],
                    'type_extension_id'=>'3',
                ]);
                //Retornamos el mensaje y a la vista de listado
                return redirect()->route('solicitudes.listar','&save=1&tipo=Prórroga especial');
            } else {
                return redirect()->route('request_extension.ingresar', ['tipo_solicitud' => 'prorroga_especial', 'id' => $request['tdg_id'], 'save' => 0])
                ->with('error','El nombre del archivo de la solicitud ya existe. Por favor cambie el nombre del archivo');
            }

        }
        
    }

    public function storeRatificacion($id_tdg, $aprobado, $id_agreement){
        //dd($id_tdg);
        //Agregar acuerdo y aprobacion de la solicitud
        $requestExtension = RequestExtension::where('tdg_id',$id_tdg)->where('aprobado',null)->get();
        foreach ($requestExtension as $request => $r_Extension) {
            # code...
           $request_Extension = RequestExtension::find($r_Extension->id);
           
           $request_Extension->aprobado = $aprobado;
           $request_Extension->agreement_id = $id_agreement;
           $request_Extension->save();
        }
       // dd($request_Extension);
       return $request_Extension;
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
