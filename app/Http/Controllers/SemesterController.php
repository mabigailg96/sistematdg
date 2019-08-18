<?php

namespace App\Http\Controllers;
use App\Semester;

use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //
    public function create(){
        return view('semester.ingresar');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'ciclo'=>'required|in:I,II',
            'fechaInicio'=>'required',
            ]);

        $fechaInicio=$data['fechaInicio'];

        //Extracion de la fecha para poder validar que el inicio del ciclo siempre se cree en el año en curso
        $fechaEntera=strtotime($fechaInicio);
        $anio=date("Y",$fechaEntera);

        //Se obtiene el año actual del sistema
        $anioActual=date("Y");
        


        if($anioActual==$anio)
        {
            $ciclo = $data['ciclo']."-".$anio;
            
            $semestre=Semester::create([
                'ciclo'=>$ciclo,
                'fechaInicio'=>$fechaInicio,
            ]);
            return redirect()->route('semester.ingresar', 'save=1');
        }
        else{
            $mensaje = 'Fecha no vñlida.';
            return redirect()->route('semester.ingresar', 'save=0&mensaje='.$mensaje);
        }
        
    



    }
}
