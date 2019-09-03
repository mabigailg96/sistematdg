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
      
        $nombre = DB::table('tdgs')->find($id);
       

        return view('requests.cambio_nombre')->with('tdgs', $nombre);
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

        dd($request_name);
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
