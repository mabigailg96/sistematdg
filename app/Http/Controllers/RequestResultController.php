<?php

namespace App\Http\Controllers;

use App\RequestResult;
use Illuminate\Http\Request;
use \DB;
use App\Tdg;

class RequestResultController extends Controller
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
        
        $tdgs = Tdg::find($id);
        
        $students = $tdgs->students;
        
       
        return view('requests.ratificacion_resultados', compact('tdgs', 'students'));
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
        //dd($request['nota'], $request['student']);
        $students = $request['student'];
        $notas = $request['nota'];
        $tdg_id = $request['tdg_id'];

        //dd($students, $notas, $tdg_id);

        $tdg = Tdg::find($tdg_id);
        //dd(sizeOf($students));

        for($i=0; $i<sizeOf($students); $i++){
            $tdg->students()->updateExistingPivot($students[$i], ['nota'=> $notas[$i]]);
        }
        return redirect()->route('solicitudes.listar','&save=1&tipo=Ratificación de Resultados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestResult  $requestResult
     * @return \Illuminate\Http\Response
     */
    public function show(RequestResult $requestResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestResult  $requestResult
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestResult $requestResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestResult  $requestResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestResult $requestResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestResult  $requestResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestResult $requestResult)
    {
        //
    }
}
