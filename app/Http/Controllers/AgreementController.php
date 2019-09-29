<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreement;
use App\Tdg;
use \DB;

class AgreementController extends Controller
{
  public function create($tipo_solicitud, $id)
  {
    //dd($tipo_solicitud, $id);
    return view('agreement.ingresar')->with('tipo_solicitud', $tipo_solicitud)->with('id', $id);
  }

  public function allJdAcuerdos(Request $request){

    /*Funcion Creada por Guillermo Cornejo*/
    //Primero inicializamos las variables

    $nombre_acuerdo =   '';
    $nombre_acuerdo =   $request->nombre;
    $fecha_acuerdo  =   '';
    $fecha_acuerdo  =   $request->fecha;


    //Realizando la consulta a la base de datos para obtener los acuerdos
    $acuerdos = DB::table('agreements')
    ->select('nombre', 'url', 'fecha')
    ->where('nombre', 'like', '%'.$nombre_acuerdo.'%')
    ->where('fecha', 'like', '%'.$fecha_acuerdo.'%')
    ->get();


    return $acuerdos;

  }

  public function store(Request $request)
  {
      $data = $request->validate([
          'nombre'=>'required|unique:agreements',
          'url'=>'required|unique:agreements',
          'fecha'=>'required',
          ]);
        //Obtenemos si fue aprobado o rechazado
        $aprobado = $request['aprobado'];
        
        //Obtenemos el tipo de solicitud que se ratificara para saber en que tabla de solicitudes asignar el acuerdo
        $tipo_solicitud = '';
      $tipo_solicitud = $request['tipo_solicitud'];
    
      $id_tdg = $request['id_tdg'];
      
      $file = $request->file('url');

      //obtenemos el nombre del archivo
      $nombrearchivo = $file->getClientOriginalName();

      $compnombre=Agreement::all();
      //metodo que comprueba si el nombre del acuerdo
      $nom=0;
      if($compnombre)
      {
          foreach($compnombre as $existe)
          {
              if($existe->url==$nombrearchivo)
              $nom=1;
          }
      }

      if($nom==0)
      {
          \Storage::disk('localac')->put($nombrearchivo,  \File::get($file));
          $data = $request->all();
        $agreement=Agreement::create([
            'nombre'=>$data['nombre'],
            'url'=>$nombrearchivo,
            'fecha'=>$data['fecha'],
        ]);
          
        if($tipo_solicitud == 'cambio_de_nombre'){

          $requestName = new RequestNameController();
         $request_name =  $requestName->storeRatificacion($id_tdg, $aprobado, $agreement->id);
         if($aprobado =='1'){
          $tdg_controller = new  TdgController();
          $tdg = $tdg_controller->updateName($request_name->nuevo_nombre, $id_tdg);
         }
        

        }else if($tipo_solicitud == 'prorroga' ){

          $requestExtension = new RequestExtensionController();
          $request_Extension =  $requestExtension->storeRatificacion($id_tdg, $aprobado, $agreement->id);

        }else if($tipo_solicitud == 'nombramiento_de_tribunal'){

        $requestTribunal = new RequestTribunalController();
        $request_Tribunal =  $requestTribunal->storeRatificacion($id_tdg, $aprobado, $agreement->id);

        }else if($tipo_solicitud=='ratificacion_de_resultados'){

          $requestResult = new RequestResultController();
        $request_Result =  $requestResult->storeRatificacion($id_tdg, $aprobado, $agreement->id);

        }else if($tipo_solicitud=='aprobado'){
          $requestApproved = new RequestApprovedController();
         
          $request_Approved =  $requestApproved->storeRatificacion($id_tdg, $aprobado, $agreement->id);
        }else if($tipo_solicitud=='oficializacion'){
          $requestOfficial = new RequestOfficialController();
         
          $request_Official =  $requestOfficial->storeRatificacion($id_tdg, $aprobado, $agreement->id);
        }

        //Ver como mostrar mensajes de error.
        return redirect('/listar/tdg/ratificacion')->with('info','Acuerdo guardado con éxito');
      }
      else {
          return redirect()->route('agreement.ingresar', '/?save=0&nombre='.$request->nombre)
          ->with('error','El nombre del acuerdo ya existe. Por favor cambie el nombre del archivo');
      }
  }
}
