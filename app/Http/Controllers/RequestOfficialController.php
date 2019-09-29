<?php

namespace App\Http\Controllers;

use App\RequestOfficial;
use Illuminate\Http\Request;

class RequestOfficialController extends Controller
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
    public function create()
    {
        //
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

    public function storeRatificacion($id_tdg, $aprobado, $id_agreement)
    {
        //
         //Agregar acuerdo y aprobacion de la solicitud
         $requestOfficial = RequestOfficial::where('tdg_id',$id_tdg)->where('aprobado',null)->get();
         foreach ($requestOfficial as $request => $r_Official) {
             # code...
            $request_Official = RequestOfficial::find($r_Official->id);
            
            $request_Official->aprobado = $aprobado;
            $request_Official->agreement_id = $id_agreement;
            $request_Official->save();
         }
        return $requestOfficial;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestOfficial  $requestOfficial
     * @return \Illuminate\Http\Response
     */
    public function show(RequestOfficial $requestOfficial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestOfficial  $requestOfficial
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestOfficial $requestOfficial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestOfficial  $requestOfficial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestOfficial $requestOfficial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestOfficial  $requestOfficial
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestOfficial $requestOfficial)
    {
        //
    }
}
