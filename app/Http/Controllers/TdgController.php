<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tdg;
use App\Student;
use App\Professor;
use App\Adviser;
use App\Ciclo;
use App\RequestOfficial;
use App\RequestName;
use App\RequestExtension;
use App\RequestTribunal;
use App\RequestResult;
use App\RequestApproved;
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

            //Aqui guardamos la solicitud para apobacion ya que es el primer paso del proceso, donde se sube el perfil en espera de la respuesta
            $requestApproved=new RequestApprovedController();
            $approved=$requestApproved->store($tdg->id);
            

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

            //Validamos que existan prorrogas de tipo 2
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
            ->leftJoin('request_officials', 'tdgs.id', '=', 'request_officials.tdg_id')
            ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre')
            ->where('request_officials.tdg_id', '=', NULL)
            ->where('tdgs.escuela_id', '=', $escuela_id)
            ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
            ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
            ->get();
        return $tdgs;
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para asignar docentes, estudiantes y asesores
    public function createAsignaciones($id){
        // Inicializar variables
        $escuela_id = auth()->user()->college_id;

        $tdg = DB::table('tdgs')
            ->leftJoin('request_officials', 'tdgs.id', '=', 'request_officials.tdg_id')
            ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre')
            ->where('request_officials.tdg_id', '=', NULL)
            ->where('tdgs.escuela_id', '=', $escuela_id)
            ->where('tdgs.id', '=', $id)
            ->get();
        
        if (!$tdg->isEmpty()) {
            return view('assignments.ingresar')->with('tdg', $tdg[0]);
        } else {
            return redirect()->route('assignments.filtro');
        }
    }

    // Está función guarda todas las asignaciones de docente, estudiantes y asesores. También crea la solicitud para oficialización.
    public function storeAsignaciones(Request $request){
        // Inicializar variables
        $tdg_id = $request->tdg_id;
        $professor_id = $request->professor_id;
        $students = json_decode($request->students);
        $advisers_internal = json_decode($request->advisers_internal);
        $advisers_external = json_decode($request->advisers_external);
        
        $escuela_id = auth()->user()->college_id;
        
        $oficializacion = new RequestOfficial();
        $retornar = true;
        

        /*
            Actualizar campo profesor_id para asignar el docente director
        */
            
        $tdg = Tdg::find($tdg_id);
        $tdg->profesor_id = $professor_id;
        $tdg->save();
            
        /*
            Asignar integrates
        */

        //$ciclo = Ciclo::orderby('created_at','DESC')->take(1)->get();

        for ($i=0; $i < sizeof($students); $i++) { 
            $tdg->students()->attach($students[$i], ['ciclo_id' => 4]);
        }

        /*
            Asignar asesores internos
        */
            
        for ($i=0; $i < sizeof($advisers_internal); $i++) { 
            DB::table('professor_tdg')->insert(['tdg_id' => $tdg_id, 'professor_id' => $advisers_internal[$i]]);
        }

        /*
            Asignar asesores externos
        */
 
        for ($i=0; $i < sizeof($advisers_external); $i++) {
            $adviser_ex = json_decode($advisers_external[$i]);
            $adviser = new Adviser();

            $adviser->nombre = $adviser_ex[0];
            $adviser->apellido = $adviser_ex[1];
            $adviser->save();

            $tdg->advisers()->attach($adviser->id);
        }

        /*
            Crear la solicitud de oficialización
        */

        $existe = DB::table('tdgs')
            ->join('request_officials', 'tdgs.id', '=', 'request_officials.tdg_id')
            ->select('tdgs.id', 'request_officials.aprobado')
            ->where('tdgs.escuela_id', '=', $escuela_id)
            ->where('tdgs.id', '=', $tdg_id)
            ->get();

        if ($existe->isEmpty()) {
            // Crear objeto a guardar
            $oficializacion->fecha = date("y-m-d");
            $oficializacion->aprobado = 0;
            $oficializacion->tdg_id = $tdg_id;
            $oficializacion->save();

        } else {
            $retornar = false;
        }

        if ($retornar) {
            return response()->json([
                'oficializacion' => $oficializacion,
                'mensaje' => 'registrado',
            ]);
        } else {
            return response()->json([
                'mensaje' => 'ya existe',
            ]);
        }
    }
    //esta funcion se consulta mediante ajax para traer los tdg filtrados por codigo,nombre,escuela para asignarle su ratificacion
    public function allTdgRatificacion(Request $request){

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
            //Solicitudes de cambio de nombre
            $request_name = RequestName::where('aprobado',null)->get();
            $tdgs = array();
            //Validacion para que existan solicitudes de cambio de nombre
            if($request_name->isEmpty()){

            }else{
                //Si existen las recorremos
                foreach($request_name as $re1){
                    $enable_name[]= $re1->tdg_id;
                }

                //Pasamos las solicitudes
                $enable_request = $enable_name;

            foreach($enable_request as $enable){
                 //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
                $consulta = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre')
                ->where('escuela_id', 'like', '%'.$escuela_id.'%')
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.id','=',$enable)
                ->get();

                if(!$consulta->isEmpty()){
                    array_push($tdgs, $consulta);
                }
            }
        }
        } else if($tipo_solicitud == 'prorroga'){
            //Solicitudes de prorroga
            $request_extension1 = RequestExtension::where('aprobado',null)->where('type_extension_id',1)->get();
            $tdgs = array();
            //Validacion para que existan solicitudes prorroga
            if($request_extension1->isEmpty()){

            }else{
                //Si existen las recorremos
                foreach($request_extension1 as $re1){
                    $enable_extension1[]= $re1->tdg_id;
                }

                //Pasamos las solicitudes
                $enable_request = $enable_extension1;

            foreach($enable_request as $enable){
                 //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
                $consulta = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre')
                ->where('escuela_id', 'like', '%'.$escuela_id.'%')
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.id','=',$enable)
                ->get();

                if(!$consulta->isEmpty()){
                    array_push($tdgs, $consulta);
                }
            }
        }
        } else if($tipo_solicitud == 'extension_de_prorroga'){

            //Solicitudes de extension de prorroga
            $request_extension2 = RequestExtension::where('aprobado',null)->where('type_extension_id',2)->get();
            $tdgs = array();
            //Validacion para que existan solicitudes prorroga
            if($request_extension2->isEmpty()){

            }else{
                //Si existen las recorremos
                foreach($request_extension2 as $re2){
                    $enable_extension2[]= $re2->tdg_id;
                }

                //Pasamos las solicitudes
                $enable_request = $enable_extension2;

            foreach($enable_request as $enable){
                 //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
                $consulta = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre')
                ->where('escuela_id', 'like', '%'.$escuela_id.'%')
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.id','=',$enable)
                ->get();

                if(!$consulta->isEmpty()){
                    array_push($tdgs, $consulta);
                }
            }
        }

        } else if($tipo_solicitud == 'prorroga_especial'){
         //Solicitudes de extension de prorroga
         $request_extension3 = RequestExtension::where('aprobado',null)->where('type_extension_id',3)->get();
         $tdgs = array();
         //Validacion para que existan solicitudes prorroga
         if($request_extension3->isEmpty()){

         }else{
             //Si existen las recorremos
             foreach($request_extension3 as $re3){
                 $enable_extension3[]= $re3->tdg_id;
             }

             //Pasamos las solicitudes
             $enable_request = $enable_extension3;

         foreach($enable_request as $enable){
              //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
             $consulta = DB::table('tdgs')
             ->select('id', 'codigo', 'nombre')
             ->where('escuela_id', 'like', '%'.$escuela_id.'%')
             ->where('codigo', 'like', '%'.$codigo.'%')
             ->where('nombre', 'like', '%'.$nombre.'%')
             ->where('tdgs.id','=',$enable)
             ->get();

             if(!$consulta->isEmpty()){
                 array_push($tdgs, $consulta);
             }
         }
     }  
           
        } else if($tipo_solicitud == 'nombramiento_de_tribunal'){
           //Solicitudes de nombramiento tribunal
           $request_tribunal = RequestTribunal::where('aprobado',null)->get();
           $tdgs = array();
           //Validacion para que existan solicitudes nombramiento tribunal
           if($request_tribunal->isEmpty()){

           }else{
               //Si existen las recorremos
               foreach($request_tribunal as $re2){
                   $enable_tribunal[]= $re2->tdg_id;
               }

               //Pasamos las solicitudes
               $enable_request = $enable_tribunal;

           foreach($enable_request as $enable){
                //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
               $consulta = DB::table('tdgs')
               ->select('id', 'codigo', 'nombre')
               ->where('escuela_id', 'like', '%'.$escuela_id.'%')
               ->where('codigo', 'like', '%'.$codigo.'%')
               ->where('nombre', 'like', '%'.$nombre.'%')
               ->where('tdgs.id','=',$enable)
               ->get();

               if(!$consulta->isEmpty()){
                   array_push($tdgs, $consulta);
               }
           }
       }
       
        } 
        else if($tipo_solicitud == 'ratificacion_de_resultados') {
         //Solicitudes de extension de resultado
         $request_results = RequestResult::where('aprobado',null)->get();
         $tdgs = array();
         //Validacion para que existan solicitudes resultado
         if($request_results->isEmpty()){

         }else{
             //Si existen las recorremos
             foreach($request_results as $re2){
                 $enable_results[]= $re2->tdg_id;
             }

             //Pasamos las solicitudes
             $enable_request = $enable_results;

         foreach($enable_request as $enable){
              //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
             $consulta = DB::table('tdgs')
             ->select('id', 'codigo', 'nombre')
             ->where('escuela_id', 'like', '%'.$escuela_id.'%')
             ->where('codigo', 'like', '%'.$codigo.'%')
             ->where('nombre', 'like', '%'.$nombre.'%')
             ->where('tdgs.id','=',$enable)
             ->get();

             if(!$consulta->isEmpty()){
                 array_push($tdgs, $consulta);
             }
         }
     }
        }
else if($tipo_solicitud=='aprobado'){
     //Solicitudes de extension de resultado
     $request_approved = RequestApproved::where('aprobado',null)->get();
     $tdgs = array();
     //Validacion para que existan solicitudes resultado
     if($request_approved->isEmpty()){

     }else{
         //Si existen las recorremos
         foreach($request_approved as $re2){
             $enable_approved[]= $re2->tdg_id;
         }

         //Pasamos las solicitudes
         $enable_request = $enable_approved;

     foreach($enable_request as $enable){
          //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
         $consulta = DB::table('tdgs')
         ->select('id', 'codigo', 'nombre')
         ->where('escuela_id', 'like', '%'.$escuela_id.'%')
         ->where('codigo', 'like', '%'.$codigo.'%')
         ->where('nombre', 'like', '%'.$nombre.'%')
         ->where('tdgs.id','=',$enable)
         ->get();

         if(!$consulta->isEmpty()){
             array_push($tdgs, $consulta);
         }
     }
}
}else if($tipo_solicitud == 'oficializacion'){
      //Solicitudes de extension de resultado
      $request_official = RequestOfficial::where('aprobado',null)->get();
      $tdgs = array();
      //Validacion para que existan solicitudes resultado
      if($request_official->isEmpty()){
 
      }else{
          //Si existen las recorremos
          foreach($request_official as $re2){
              $enable_official[]= $re2->tdg_id;
          }
 
          //Pasamos las solicitudes
          $enable_request = $enable_official;
 
      foreach($enable_request as $enable){
           //Tdg::where('id',$enable)->where('nombre', 'like', '%WP%')->get();
          $consulta = DB::table('tdgs')
          ->select('id', 'codigo', 'nombre')
          ->where('escuela_id', 'like', '%'.$escuela_id.'%')
          ->where('codigo', 'like', '%'.$codigo.'%')
          ->where('nombre', 'like', '%'.$nombre.'%')
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


    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para gestionar tdg por coordinador de escuela
    public function allTdgGestionarGeneral(Request $request){
        
        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $estado_oficial = '';
        $estado_oficial = $request->estado_oficial;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;

        // Realizar consultas a la base de datos
        if ($request->escuela_id == null && $request->estado_oficial == null) {

            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->get();

        } else if ($request->escuela_id == null && $request->estado_oficial == 'Recien ingresado') {

            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->whereNull('estado_oficial')
                ->get();

        } else if ($request->escuela_id != null && $request->estado_oficial == null) {

            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->get();

        } else if ($request->escuela_id != null && $request->estado_oficial == 'Recien ingresado') {

            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->whereNull('estado_oficial')
                ->get();

        } else if ($request->escuela_id == null && $request->estado_oficial != 'Recien ingresado' && $request->estado_oficial != null) {

            $tdgs = DB::table('tdgs')
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->where('estado_oficial', '=', $estado_oficial)
                ->get();

        } else if ($request->escuela_id != null && $request->estado_oficial != 'Recien ingresado' && $request->estado_oficial != null) {

            $tdgs = DB::table('tdgs')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->where('estado_oficial', '=', $estado_oficial)
                ->get();
                    
        }
    
        return $tdgs;
    }

    // Función para mostrar la pantalla de detalles de tdg para coordinador general
    public function createDetalleTdgGeneral($id){
        // Inicializar variables
        $tdg_id = $id;
    
        $tdg_prueba = DB::table('tdgs')
            ->select('id', 'profesor_id')
            ->where('id', '=', $tdg_id)
            ->get();
    
        if (!$tdg_prueba->isEmpty()) {
    
            if ($tdg_prueba[0]->profesor_id == NULL) {
                $tdg = DB::table('tdgs')
                    ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                    ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'tdgs.estado_oficial', 'semesters.fechaInicio')
                    ->where('tdgs.id', '=', $tdg_id)
                    ->get();
                    
                $tdg[0]->profesor_nombre = '';
                $tdg[0]->profesor_apellido = '';
            } else {
                $tdg = DB::table('tdgs')
                    ->join('professors', 'tdgs.profesor_id', '=', 'professors.id')
                    ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                    ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'tdgs.estado_oficial', 'professors.nombre as profesor_nombre', 'professors.apellido as profesor_apellido', 'semesters.fechaInicio')
                    ->where('tdgs.id', '=', $tdg_id)
                    ->get();
            }
    
            $students = DB::table('student_tdg')
                ->join('students', 'student_tdg.student_id', '=', 'students.id')
                ->select('student_tdg.id as student_tdg_id', 'students.id', 'students.carnet', 'students.nombres', 'students.apellidos', 'student_tdg.activo')
                ->where('student_tdg.tdg_id', '=', $tdg_id)
                ->get();
                
            if ($students->isEmpty()) {
                $students = [];
            }
                
            $advisers_internal = DB::table('professor_tdg')
                ->join('professors', 'professor_tdg.professor_id', '=', 'professors.id')
                ->select('professors.id', 'professors.nombre', 'professors.apellido')
                ->where('professor_tdg.tdg_id', '=', $tdg_id)
                ->get();
                
            if ($advisers_internal->isEmpty()) {
                $advisers_internal = [];
            }
    
            $advisers_external = DB::table('adviser_tdg')
                ->join('advisers', 'adviser_tdg.adviser_id', '=', 'advisers.id')
                ->select('advisers.id', 'advisers.nombre', 'advisers.apellido')
                ->where('adviser_tdg.tdg_id', '=', $tdg_id)
                ->get();
                
            if ($advisers_external->isEmpty()) {
                $advisers_external = [];
            }
    
            return view('tdg.ver_detalles_general', ['tdg' => $tdg[0], 'students' => $students, 'advisers_internal' => $advisers_internal, 'advisers_external' => $advisers_external]);
        } else {
            return redirect()->route('tdg.filtroGestionarGeneral');
        }
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para gestionar tdg por coordinador de escuela
    public function allTdgGestionarEscuela(Request $request){
        
        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $estado_oficial = '';
        $estado_oficial = $request->estado_oficial;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;
        // Realizar consultas a la base de datos
        if ($request->estado_oficial == null) {
            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->get();
        } else if ($request->estado_oficial == 'Recien ingresado') {
            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->whereNull('estado_oficial')
                ->get();
        } else if ($request->estado_oficial != 'Recien ingresado' && $request->estado_oficial != null) {
            $tdgs = DB::table('tdgs')
                ->select('id', 'codigo', 'nombre', 'estado_oficial')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$codigo.'%')
                ->where('nombre', 'like', '%'.$nombre.'%')
                ->where('estado_oficial', '=', $estado_oficial)
                ->get();
        }
        
        return $tdgs;
    }

    // Función para mostrar la pantalla de detalles de tdg para coordinador de escuela
    public function createDetalleTdgEscuela($id){
        // Inicializar variables
        $escuela_id = auth()->user()->college_id;
        $tdg_id = $id;

        $tdg_prueba = DB::table('tdgs')
            ->select('id', 'profesor_id')
            ->where('escuela_id', '=', $escuela_id)
            ->where('id', '=', $tdg_id)
            ->get();

        if (!$tdg_prueba->isEmpty()) {

            if ($tdg_prueba[0]->profesor_id == NULL) {
                $tdg = DB::table('tdgs')
                    ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                    ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'tdgs.estado_oficial', 'semesters.fechaInicio')
                    ->where('tdgs.escuela_id', '=', $escuela_id)
                    ->where('tdgs.id', '=', $tdg_id)
                    ->get();
                
                $tdg[0]->profesor_nombre = '';
                $tdg[0]->profesor_apellido = '';
            } else {
                $tdg = DB::table('tdgs')
                    ->join('professors', 'tdgs.profesor_id', '=', 'professors.id')
                    ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                    ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'tdgs.estado_oficial', 'professors.nombre as profesor_nombre', 'professors.apellido as profesor_apellido', 'semesters.fechaInicio')
                    ->where('tdgs.escuela_id', '=', $escuela_id)
                    ->where('tdgs.id', '=', $tdg_id)
                    ->get();
            }

            $students = DB::table('student_tdg')
                ->join('students', 'student_tdg.student_id', '=', 'students.id')
                ->select('student_tdg.id as student_tdg_id', 'students.id', 'students.carnet', 'students.nombres', 'students.apellidos', 'student_tdg.activo')
                ->where('student_tdg.tdg_id', '=', $tdg_id)
                ->get();
            
            if ($students->isEmpty()) {
                $students = [];
            }
            
            $advisers_internal = DB::table('professor_tdg')
                ->join('professors', 'professor_tdg.professor_id', '=', 'professors.id')
                ->select('professors.id', 'professors.nombre', 'professors.apellido')
                ->where('professor_tdg.tdg_id', '=', $tdg_id)
                ->get();
            
            if ($advisers_internal->isEmpty()) {
                $advisers_internal = [];
            }

            $advisers_external = DB::table('adviser_tdg')
                ->join('advisers', 'adviser_tdg.adviser_id', '=', 'advisers.id')
                ->select('advisers.id', 'advisers.nombre', 'advisers.apellido')
                ->where('adviser_tdg.tdg_id', '=', $tdg_id)
                ->get();
            
            if ($advisers_external->isEmpty()) {
                $advisers_external = [];
            }

            return view('tdg.ver_detalles_escuela', ['tdg' => $tdg[0], 'students' => $students, 'advisers_internal' => $advisers_internal, 'advisers_external' => $advisers_external]);
        } else {
            return redirect()->route('tdg.filtroGestionarEscuela');
        }
    }

    // Función para cambiar estado de tdg a abandonado
    public function abandonarTdg(Request $request) {
        // Inicializar variables
        $tdg_id = $request->tdg_id;

        // Actualizr estado a abandonado
        $tdg = Tdg::find($tdg_id);
        $tdg->estado_oficial = 'Abandonado';
        $tdg->save();

        return response()->json([
            'tdg' => $tdg,
        ]);
    }
    public function updateName($nuevo_nombre, $id_tdg){

        $tdgUpdate = Tdg::find($id_tdg);
        $tdgUpdate->nombre = $nuevo_nombre;
        $tdgUpdate->save();
        return $tdgUpdate;
    }

    public function updateCodigo($id_tdg){

        $tdgUpdate = Tdg::find($id_tdg);
        $newCodigo = substr($tdgUpdate->codigo, 1, 9);
        $tdgUpdate->codigo = $newCodigo;
        $tdgUpdate->save();
        return $tdgUpdate;
    }

}
