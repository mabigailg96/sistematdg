<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonthExtension;

class MonthExtensionController extends Controller
{
    
    public function allExtension(){

        $months = MonthExtension::paginate();

        return view('monthExtension.listar_extension')->with('months', $months);
    }

    public function edit($id) 
    {
        //dd($id);
        $month = MonthExtension::find($id);
        //dd($month);
        return view('monthExtension.actualizar',compact('month'));
    }

    public function update(Request $request, $id)
    {
        $newMonth = $request->validate([
            'tipo'    => 'required',
            'meses'  => 'required'
        ]);

        //dd($newMonth['tipo'], $id);
        $updateMonth = MonthExtension::find($id);
        //Primero que se actualice el usario
        $updateMonth->update([
            'tipo' => $newMonth['tipo'],
            'meses'=>$newMonth['meses'],
        ]);
        //Segundo que se actualicen los roles
        return redirect()->route('month.show','save=1')
        ->with('info','Prórroga actualizada con exito');
    }
}
