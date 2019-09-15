<?php

namespace App\Http\Controllers;

use App\RequestExtension;
use Illuminate\Http\Request;
use \DB;
use App\Tdg;

class RequestExtensionController extends Controller
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
    public function create($tipo_solicitud,$id)
    {
        //
      

        $tdg = Tdg::find($id);
        $ciclo = DB::table('semesters')->find($tdg->ciclo_id);
        //Rescatar el ciclo del tdg que esta en curso.
        $ciclo_id = $tdg->students()->where('tdg_id', $tdg->id)->first()->pivot->ciclo_id;
        $ciclo = DB::table('semesters')->find($ciclo_id);
       
       if($tipo_solicitud=='prorroga')
        {
        return view('requests.prorroga')->with('tdgs', $tdg)->with('ciclo', $ciclo);
        }
        else if ($tipo_solicitud=='extension_de_prorroga')
        {
            return view('requests.extension_prorroga')->with('tdgs', $tdg); 
        }
        else if ($tipo_solicitud=='prorroga_especial')
        {
            return view('requests.prorroga_especial')->with('tdgs', $tdg); 
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function show(RequestExtension $requestExtension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestExtension $requestExtension)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestExtension $requestExtension)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestExtension  $requestExtension
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestExtension $requestExtension)
    {
        //
    }
}
