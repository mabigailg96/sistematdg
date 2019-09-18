<?php

namespace App\Http\Controllers;

use App\RequestTribunal;
use Illuminate\Http\Request;
use \DB;

class RequestTribunalController extends Controller
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
        // Inicializar variables
        $escuela_id = auth()->user()->college_id;

        /*$tdg = DB::table('tdgs')
            ->leftJoin('request_officials', 'tdgs.id', '=', 'request_officials.tdg_id')
            ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre')
            ->where('request_officials.tdg_id', '=', NULL)
            ->where('tdgs.escuela_id', '=', $escuela_id)
            ->where('tdgs.id', '=', $id)
            ->get();
        */

        
        /*if (!$tdg->isEmpty()) {
            return view('assignments.ingresar')->with('tdg', $tdg[0]);
        } else {
            return redirect()->route('assignments.filtro');
        }*/
        $nombre = DB::table('tdgs')->find($id);
        return view('requests.nombramiento_tribunal')->with('tdgs', $nombre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Inicializar variables
        $tdg_id = $request->tdg_id;

        // Crear objeto a guardar
        $request_tribunal = new RequestTribunal();
        $request_tribunal->fecha = date("y-m-d");
        $request_tribunal->tdg_id = $tdg_id;
        $request_tribunal->save();

        return $request_tribunal;
    }

    public function storeRequestTribunalProfessor(Request $request)
    {
        // Inicializar variables
        $professor_id = $request->professor_id;
        $request_tribunal_id = $request->request_tribunal_id;
    
        $request_tribunal = RequestTribunal::find($request_tribunal_id);

        $request_tribunal->professors()->attach($professor_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestTribunal  $requestTribunal
     * @return \Illuminate\Http\Response
     */
    public function show(RequestTribunal $requestTribunal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestTribunal  $requestTribunal
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestTribunal $requestTribunal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestTribunal  $requestTribunal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestTribunal $requestTribunal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestTribunal  $requestTribunal
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestTribunal $requestTribunal)
    {
        //
    }
}
