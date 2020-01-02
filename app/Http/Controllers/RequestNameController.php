<?php

namespace App\Http\Controllers;

use App\RequestName;
use App\Tdg;
use Illuminate\Http\Request;
use \DB;
class RequestNameController extends Controller
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
    public function create($id)
    {
        //
      
        $tdg = DB::table('tdgs')->find($id);
       

        return view('requests.cambio_nombre')->with('tdgs', $tdg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request_name = $request->validate([
            'nombre_nuevo' => 'required',
            'justificacion' => 'required',
        ]);
           
        $name = RequestName::create([
            'fecha' => date("y-m-d"),
            'nuevo_nombre' => $request_name['nombre_nuevo'],
            'justificacion' => $request_name['justificacion'],
            'nombre_anterior'=> $request['nombre_anterior'],
            'tdg_id' => $request['tdg_id'],
        ]);

        return redirect()->route('solicitudes.listar','&save=1&tipo=Cambio de nombre');
    }

    //Metodo para agregar el acuerdo de JD, para ratificarla. Recibe codigo tdg, aprobado(aceptado 1, denegado 0), id acuerdo 
    public function storeRatificacion($id_tdg, $aprobado, $id_agreement){
        //dd($id_tdg);
        //Agregar acuerdo y aprobacion de la solicitud
        $requestName = RequestName::where('tdg_id',$id_tdg)->where('aprobado',null)->get();
        foreach ($requestName as $request => $r_name) {
            # code...
           $request_name = RequestName::find($r_name->id);
           
           $request_name->aprobado = $aprobado;
           $request_name->agreement_id = $id_agreement;
           $request_name->save();
        }
       return $request_name;
    }

    public function editarNombre($id){
        $tdg = DB::table('tdgs')->find($id);

        return view('tdg.editar_tdg_nombre')->with('tdgs', $tdg);
    }

    public function guardarNombre(Request $request){
        $request_name = $request->validate([
            'nombre_nuevo' => 'required',
        ]);
        $tdg_id = $request->tdg_id;
        
        $tdgUpdate = Tdg::find($tdg_id);
        $tdgUpdate->nombre = $request_name['nombre_nuevo'];
        $tdgUpdate->save(); 
        
        return redirect()->route('tdg.filtroTdgEditar','&save=1&tipo=Nombre');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestName  $requestName
     * @return \Illuminate\Http\Response
     */
    public function show(RequestName $requestName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestName  $requestName
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestName $requestName)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestName  $requestName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestName $requestName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestName  $requestName
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestName $requestName)
    {
        //
    }
}
