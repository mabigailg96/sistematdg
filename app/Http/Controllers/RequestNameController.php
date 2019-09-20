<?php

namespace App\Http\Controllers;

use App\RequestName;
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
            'tdg_id' => $request['tdg_id'],
        ]);

        return redirect()->route('solicitudes.listar','&save=1&tipo=Cambio de nombre');
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
