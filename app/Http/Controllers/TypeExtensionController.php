<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeExtension;

class TypeExtensionController extends Controller
{
    
    public function allExtension(){

        $months = TypeExtension::paginate();

        return view('monthExtension.listar_extension')->with('months', $months);
    }

    public function edit($id) 
    {
        //dd($id);
        $month = TypeExtension::find($id);
        //dd($month);
        return view('monthExtension.actualizar',compact('month'));
    }

    public function update(Request $request, $id)
    {
        $newMonth = $request->validate([
            'meses'  => 'required'
        ]);

        //dd($newMonth['tipo'], $id);
        $updateMonth = TypeExtension::find($id);
        //Primero que se actualice el usario
        $updateMonth->update([
            'tipo' => $request['tipo'],
            'meses'=>$newMonth['meses'],
        ]);
        //Segundo que se actualicen los roles
        return redirect()->route('month.show','save=1')
        ->with('info','Prórroga actualizada con exito');
    }
}
