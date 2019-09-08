<?php

namespace App\Http\Controllers;

use App\RequestExtension;
use Illuminate\Http\Request;
use \DB;

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
      

        $nombre = DB::table('tdgs')->find($id);
       
       if($tipo_solicitud=='prorroga')
        {
        return view('requests.prorroga')->with('tdgs', $nombre);
        }
        else if ($tipo_solicitud=='extension_de_prorroga')
        {
            return view('requests.extension_prorroga')->with('tdgs', $nombre); 
        }
        else if ($tipo_solicitud=='prorroga_especial')
        {
            return view('requests.prorroga_especial')->with('tdgs', $nombre); 
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
