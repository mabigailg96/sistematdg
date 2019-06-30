<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreement;

class AgreementController extends Controller
{
  public function index()
  {
    return view('agreement.ingresar');
  }

  public function store(Request $request)
  {
      $data = $request->validate([
          'nombre'=>'required|unique:agreements',
          'url'=>'required|unique:agreements',
          ]);

      $file = $request->file('url');

      //obtenemos el nombre del archivo
      $nombre = $file->getClientOriginalName();

      $nombreexiste=Agreement::all();
      $nom=0;
      if($nombreexiste)
      {
          foreach($nombreexiste as $existe)
          {
              if($existe->url==$nombre)
              $nom=1;
          }
      }

      if($nom==0)
      {
          \Storage::disk('localac')->put($nombre,  \File::get($file));
          $data = $request->all();
        $agreement=Agreement::create([
            'nombre'=>$data['nombre'],
            'url'=>$nombre,
        ]);

        return redirect()->route('agreement.ingresar', $agreement->id.'&save=1')->with('info','Acuerdo guardado con éxito');
      }
      else {
          return redirect()->route('agreement.ingresar', '/?save=0&nombre='.$request->nombre)
          ->with('error','El nombre del acuerdo ya existe. Por favor cambie el nombre del archivo');
      }
  }
}
