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
        //
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
