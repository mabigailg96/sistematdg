<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tdg;
use App\RequestOfficial;
use App\RequestName;
use App\RequestExtension;
use App\RequestTribunal;
use App\RequestResult;
use \DB;
use SebastianBergmann\Environment\Console;

class TdgController extends Controller
{
    //

    public function create()
    {
        $ciclos = new SemesterController();

        return view('tdg.ingresar', ['ciclos' => $ciclos->viewSemesters()]);
    }

    public function store(Request $request)
    {
        $perfil = $request->validate([
            'nombre' => 'required|unique:tdgs',
            'perfil' => 'required|unique:tdgs',
            'ciclo_id' => 'required',
        ]);

        // Rescatando el ciclo a que pertenece el tdg
        $ciclo_request = $request->Input('ciclo_id');
        $ciclo_id = (int) $ciclo_request;

        //Rescatar escuela del usuario
        $escuela_request = $request->Input('college_id');
        $escuela_id = (int) $escuela_request;

        //Rescatando el ultimo tdgs ingresado en la base de datos.
        $lastTdg = DB::table('tdgs')->where('escuela_id', '=', $escuela_id)->orderBy('id', 'DESC')->first();
        //psi19001
        if ($lastTdg == null) {
            $lastCorrelativo = 0;
        } else {
            //Partiendo el codigo del TDG para solo extraer el correlativo.
            $lastCorrelativo = (int) substr($lastTdg->codigo, strlen($lastTdg->codigo) - 3, strlen($lastTdg->codigo));
        }

        //Hacer codigo de TDG

        //Obteniendo la escuela.
        $escuela = DB::table('colleges')->find($escuela_id);
        $correlativo = '';

        //Verificando el ultimo id, para completar el correlativo.
        if ($lastCorrelativo <= 9) {
            $correlativo = '00';
        }
        if ($lastCorrelativo > 9 && $lastCorrelativo <= 99) {
            $correlativo = '0';
        }

        //Nuevo codigo TDG
        $codigo = 'P' . $escuela->nombre . date("y") . $correlativo . ($lastCorrelativo + 1);

        //Guardar archivos
        $file = $request->file('perfil');

        //obtenemos el nombre del archivo
        $nombre_archivo = $file->getClientOriginalName();

        //Obtenemos todos los TDG para verificar que el nombre del archivo no exista.
        $existeTDG = DB::table('tdgs')
            ->select('perfil')
            ->get();


        $existe = 0;
        if ($existeTDG) {
            //Verificando que el nombre del archivo no exista.
            foreach ($existeTDG as $oldTdg) {
                if ($oldTdg->perfil == $nombre_archivo)
                    $existe = 1;
            }
        }

        //Si no se encuentra ya ese archivo registrado se guarda el perfil.
        if ($existe == 0) {
            \Storage::disk('localp')->put($nombre_archivo,  \File::get($file));

            //Guardarmos el TDG.
            $tdg = Tdg::create([
                'nombre' => $perfil['nombre'],
                'escuela_id' => $escuela_id,
                'codigo' => $codigo,
                'perfil' => $nombre_archivo,
                'ciclo_id' => $ciclo_id,
            ]);

            return redirect()->route('tdg.ingresar', '/?' . $escuela_id . '&save=1')
                ->with('info', 'Trabajo de graduación guardado con éxito');
        } else {
            return redirect()->route('tdg.ingresar', '/?&save=0&nombre=' . $perfil['nombre'])
                ->with('info', 'El nombre del perfil ya existe. Por favor cambie el nombre del archivo');
        }
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para solicitudes
    public function allTdgSolicitudes(Request $request){
        
        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;
        $tipo_solicitud = '';
        $tipo_solicitud = $request->tipo_solicitud;

        // Realizar consultas a la base de datos

        $tdgs = '';
        if($tipo_solicitud == 'cambio_de_nombre'){
            //Solicitudes de oficializacion aprobadas
            $request_officials = RequestOfficial::where('aprobado',1)->get();
            //Solicitudes de cambio de nombre aprobadas
            $request_names = RequestName::where('aprobado',1)->orWhere('aprobado',null)->get();
            $tdgs = array();
            //Validacion para que existan oficializados
            if($request_officials->isEmpty()){
              
            }else{
                //Si existen las recorremos
                foreach($request_officials as $re1){
                    $enable_officials[]= $re1->tdg_id;
                }

                //Validamos que existan cambios de nombres que esten aprobadas
                if(!$request_names->isEmpty()){
                    foreach($request_names as $re2){
                        $enable_names[]= $re2->tdg_id;
                    }

                    //Hacemos una diferencia para que quitar datos repetidos.
                      $enable_request = array_diff($enable_officials, $enable_names);
                    
                }else{
                    //Sino, los tdgs disponibles seran por defecto solo los que sea oficializados aprobados
                    $enable_request = $enable_officials;
                }
    
           
            foreach($enable_request as $enable){
                 //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
                $consulta =Tdg::join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.id','=',$enable)
                ->get();
            
                if(!$consulta->isEmpty()){
                    array_push($tdgs, $consulta);
                }
            }
        }
        } else if($tipo_solicitud == 'prorroga'){
           //Solicitudes de oficializacion
            $request_officials = RequestOfficial::where('aprobado',1)->get();
            //Solicitudes de prorroga de tipo 1
            $request_extensions = RequestExtension::where('aprobado',1)->where('type_extension_id',1)->orWhere('aprobado',null)->get();
            $tdgs = array();
            //Validamos que existan tdgs oficializados
            if($request_officials->isEmpty()){
             
            }else{
                //Si existen las recorremos
                foreach($request_officials as $re1){
                    $enable_officials[]= $re1->tdg_id;
                }

                //Validamos que existan prorrogas de tipo 1 que esten aprobadas
                if(!$request_extensions->isEmpty()){
                    foreach($request_extensions as $re2){
                        $enable_extensions[]= $re2->tdg_id;
                    }

                    //Hacemos una diferencia para que quitar datos repetidos
                      $enable_request = array_diff($enable_officials, $enable_extensions);
                    
                }else{
                    //Sino, los tdgs disponibles seran por defecto solo los oficializados aprobados
                    $enable_request = $enable_officials;
                }
        
        
            
            foreach($enable_request as $enable){

                $consulta =Tdg::join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.id','=',$enable)
                ->get();
            
                if(!$consulta->isEmpty()){
                    array_push($tdgs, $consulta);
                }
            }
        }
        } else if($tipo_solicitud == 'extension_de_prorroga'){

            //Rescatamos los datos para la toma de criterio
            $request_extensions_1 = RequestExtension::where('aprobado',1)->where('type_extension_id',1)->get();
            $request_extensions_2 = RequestExtension::where('aprobado',1)->where('type_extension_id',2)->orWhere('aprobado',null)->get();
            $tdgs = array();
            //Validamos que existan prorrogas de tipo 1
            if($request_extensions_1->isEmpty()){
             
            }else{
                //Si existen las recorremos
                foreach($request_extensions_1 as $re1){
                    $enable_extensions_1[]= $re1->tdg_id;
                }

                //Validamos que existan prorrogas de tipo 2 que esten validadas
                if(!$request_extensions_2->isEmpty()){
                    foreach($request_extensions_2 as $re2){
                        $enable_extensions_2[]= $re2->tdg_id;
                    }

                    //Teniendo ambas prorrogas hacemos una diferencia para que quitar datos repetidos
                      $enable_request = array_diff($enable_extensions_1, $enable_extensions_2);
                    
                }else{
                    //Sino, los tdgs disponibles seran por defecto solo los que tengan una prorroga 1 aprobada.
                    $enable_request = $enable_extensions_1;
                }

                
                foreach($enable_request as $enable){
              
                    $consulta =Tdg::join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                    ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                    ->where('tdgs.escuela_id', '=', $escuela_id)
                    ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                    ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                    ->where('tdgs.id','=',$enable)
                    ->get();
                
                    if(!$consulta->isEmpty()){
                        array_push($tdgs, $consulta);
                    } 
                }
            }
        
        } else if($tipo_solicitud == 'prorroga_especial'){
               //Rescatamos los datos para la toma de criterio
               $request_extensions_2 = RequestExtension::where('aprobado',1)->where('type_extension_id',2)->get();
              $request_extensions_3 = RequestExtension::where('aprobado',null)->where('type_extension_id',3)->get();
            
               
               $tdgs = array();

               //Validamos que existan prorrogas de tipo 1
            if($request_extensions_2->isEmpty()){
             
            }else{
                //Si existen las recorremos
                foreach($request_extensions_2 as $re2){
                    $enable_extensions_2[]= $re2->tdg_id;
                }

                //Validamos que existan prorrogas de tipo 2 que esten validadas
                if(!$request_extensions_3->isEmpty()){
                    foreach($request_extensions_3 as $re3){
                        $enable_extensions_3[]= $re3->tdg_id;
                    }

                    //Teniendo ambas prorrogas hacemos una diferencia para que quitar datos repetidos
                      $enable_request = array_diff($enable_extensions_2, $enable_extensions_3);
                    
                }else{
                    //Sino, los tdgs disponibles seran por defecto solo los que tengan una prorroga 1 aprobada.
                    $enable_request = $enable_extensions_2;
                }

             
                   foreach($enable_request as $enable){
                 
                       $consulta =Tdg::join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                       ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                       ->where('tdgs.escuela_id', '=', $escuela_id)
                       ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                       ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                       ->where('tdgs.id','=',$enable)
                       ->get();
                   
                       if(!$consulta->isEmpty()){
                           array_push($tdgs, $consulta);
                       }
                    }
                       
                }
               
           
        } else if($tipo_solicitud == 'nombramiento_de_tribunal'){
           //Rescatamos los datos para la toma de criterio
           $request_officials = RequestOfficial::where('aprobado',1)->get();
           $request_tribunal = RequestTribunal::where('aprobado',1)->orWhere('aprobado',null)->get();
           $tdgs = array();
           //Validamos que existan tdgs oficializados
           if($request_officials->isEmpty()){
        
           }else{
               //Si existen las recorremos
               foreach($request_officials as $re1){
                   $enable_officials[]= $re1->tdg_id;
               }

               //Validamos que existan solicitudes de tribunal
               if(!$request_tribunal->isEmpty()){
                   foreach($request_tribunal as $re2){
                       $enable_tribunal[]= $re2->tdg_id;
                   }

                   //Hacemos una diferencia para que quitar datos repetidos
                     $enable_request = array_diff($enable_officials, $enable_tribunal);
                   
               }else{
                   //Sino, los tdgs disponibles seran por defecto solo los oficializados aprobados.
                   $enable_request = $enable_officials;
               }
                
              
               foreach($enable_request as $enable){
             
                   $consulta =Tdg::join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                   ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                   ->where('tdgs.escuela_id', '=', $escuela_id)
                   ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                   ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                   ->where('tdgs.id','=',$enable)
                   ->get();
               
                   if(!$consulta->isEmpty()){
                       array_push($tdgs, $consulta);
                   }
                   
               }
           }
        }else{
             //Rescatamos los datos para la toma de criterio
           $request_tribunal = RequestTribunal::where('aprobado',1)->get();
           $request_result = RequestResult::where('aprobado',1)->orWhere('aprobado',null)->get();
           $tdgs = array();
           //Validamos que existan solicitudes de tribunal 
           if($request_tribunal->isEmpty()){
               
           }else{
               //Si existen las recorremos
               foreach($request_tribunal as $re1){
                   $enable_tribunal[]= $re1->tdg_id;
               }

               //Validamos que existan solicitudes de resultado
               if(!$request_result->isEmpty()){
                   foreach($request_result as $re2){
                       $enable_result[]= $re2->tdg_id;
                   }

                   //Hacemos una diferencia para que quitar datos repetidos
                     $enable_request = array_diff($enable_tribunal, $enable_result);
                   
               }else{
                   //Sino, los tdgs disponibles seran por defecto solo los que tengan tribunal aprobado
                   $enable_request = $enable_tribunal;
               }

               
               foreach($enable_request as $enable){
             
                   $consulta =Tdg::join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                   ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                   ->where('tdgs.escuela_id', '=', $escuela_id)
                   ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                   ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                   ->where('tdgs.id','=',$enable)
                   ->get();
               
                   if(!$consulta->isEmpty()){
                       array_push($tdgs, $consulta);
                   }
                   
               }
           }
        }
       
        return $tdgs;
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para asignar docentes, estudiantes y asesores
    public function allTdgAsignaciones(Request $request){
        
        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;

        // Realizar consultas a la base de datos
        $tdgs = DB::table('tdgs')
            ->select('id', 'codigo', 'nombre')
            ->where('escuela_id', '=', $escuela_id)
            ->where('codigo', 'like', '%'.$codigo.'%')
            ->where('nombre', 'like', '%'.$nombre.'%')
            ->get();

        return $tdgs;
    }
}
