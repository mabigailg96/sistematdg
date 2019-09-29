<?php

namespace App\Http\Controllers;

use App\RequestApproved;
use Illuminate\Http\Request;
use Carbon\Carbon;
class RequestApprovedController extends Controller
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
    public function store($tgd)
    {
        //
        $requestApproved=RequestApproved::create([
            'fecha'=> Carbon::now(),
            'tdg_id'=>$tgd,

        ]);
        return $requestApproved;

    }

    public function storeRatificacion($id_tdg, $aprobado, $id_agreement)
    {
        //
         //Agregar acuerdo y aprobacion de la solicitud
         $requestApproved = RequestApproved::where('tdg_id',$id_tdg)->where('aprobado',null)->get();
         foreach ($requestApproved as $request => $r_Approved) {
             # code...
            $request_Approved = RequestApproved::find($r_Approved->id);
            
            $request_Approved->aprobado = $aprobado;
            $request_Approved->agreement_id = $id_agreement;
            $request_Approved->save();
         }
        return $requestApproved;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestApproved  $requestApproved
     * @return \Illuminate\Http\Response
     */
    public function show(RequestApproved $requestApproved)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestApproved  $requestApproved
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestApproved $requestApproved)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestApproved  $requestApproved
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestApproved $requestApproved)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestApproved  $requestApproved
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestApproved $requestApproved)
    {
        //
    }
}
