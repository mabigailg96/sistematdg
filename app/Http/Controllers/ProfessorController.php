<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use App\Imports\ProfessorsImport;
use Maatwebsite\Excel\Facades\Excel;
class ProfessorController extends Controller
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
        return view('professor.ingresar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perfil =$request ->validate([

            'codigo'=> 'required|unique:professors',
            'nombre'=> 'required',
            'apellido'=> 'required',

        ]);
        $escuela = auth()->user()->college_id;
        $data = $request->all();
        Professor::create([
            'codigo'    => $data['codigo'],
            'nombre'    => $data['nombre'],
            'apellido'  => $data['apellido'],
            'escuela_id'=> $escuela,
        ]);
        return redirect()->route('professor.ingresar','/?&save=2')->with('info', 'Los profesores han sido guardados con exito');
    }

    public function storexls()
    {
        try {
            Excel::import(new ProfessorsImport, request()->file('file'));
        } catch (\Exception $ex) {
            return redirect()->route('professor.ingresar','/?&error=1')->with('info', 'Los profesores no han sido guardados');
        }

        return redirect()->route('professor.ingresar','/?&save=1')->with('info', 'Los profesores han sido guardados con exito');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //
    }
}
