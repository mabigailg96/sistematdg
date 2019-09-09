<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreement;
use \DB;

class AgreementController extends Controller
{
  public function create()
  {
    return view('agreement.ingresar');
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

        return redirect()->route('agreement.ingresar', $agreement->id.'&save=1')->with('info','Acuerdo guardado con éxito');
      }
      else {
          return redirect()->route('agreement.ingresar', '/?save=0&nombre='.$request->nombre)
          ->with('error','El nombre del acuerdo ya existe. Por favor cambie el nombre del archivo');
      }
  }
}
