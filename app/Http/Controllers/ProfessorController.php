<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use App\Imports\ProfessorsImport;
use Maatwebsite\Excel\Facades\Excel;
use \DB;

class ProfessorController extends Controller
{

    public function allprofesores(Request $request){

        //Primero inicializamos las variables

        $nombre_profesor =   '';
        $nombre_profesor =   $request->nombre;
        $codigo_profesor =   '';
        $codigo_profesor =   $request->codigo;
        $escuela_profesor =   '';
        $escuela_profesor =  auth()->user()->college_id;



        //Realizando la consulta a la base de datos para obtener los acuerdos
        $usuarios = DB::table('professors')
        ->select('id','codigo', 'nombre', 'apellido','estado')
        ->where('nombre', 'like', '%'.$nombre_profesor.'%')
        ->where('codigo', 'like', '%'.$codigo_profesor.'%')
        ->where('escuela_id', 'like', '%'.$escuela_profesor.'%')
        ->get();


        return $usuarios;

      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuela = auth()->user()->college_id;
        return view('professor.listar_profesores', compact('escuela'));
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
        $professor = $request->validate([
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

        return redirect()->route('professor.ingresar','/?save=1')->with('info', 'Los profesores han sido guardados con exito');
    }

    public function storexls(Request $request)
    {
        try {
            $professor = $request->validate([
                'file'=> 'required|mimes:xls,xlsx',
            ]);

            Excel::import(new ProfessorsImport, request()->file('file'));
        } catch (\Exception $ex) {
            return redirect()->route('professor.ingresar','/?save=0')->with('info', 'Los profesores no han sido guardados');
        }

        return redirect()->route('professor.ingresar','/?save=1')->with('info', 'Los profesores han sido guardados con exito');
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
        return view('professor.editar',compact('professor'));
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

        $data = $request->all();
        $professor->update([
            'nombre'=>$data['nombre'],
            'apellido'=>$data['apellido'],
            'codigo'=>$data['codigo'],
            'estado'=>$data['estado'],
        ]);
        return redirect()->route('professor.index','save=2')
        ->with('info','Profesor Actualizado con exito');
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

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para nombramiento de tribunal
    public function allProfessorNombramientoTribunal(Request $request){

        // Inicializar variables
        $escuela_id = auth()->user()->college_id;
        $input = $request->input;

        $professors = array();

        if($input == '') {

            $professors = DB::table('professors')
            ->select('id', 'codigo', 'nombre', 'apellido')
            ->where('escuela_id', '=', $escuela_id)
            ->get();

        } else {

            // Realizar consultas a la base de datos con las coindicencias del codigo de docente
            $professors_codigo = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$input.'%')
                ->get();

            if(!$professors_codigo->isEmpty()){
                foreach ($professors_codigo as $professor) {
                    array_push($professors, $professor);
                }
            }

            $professors_nombre = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where('escuela_id', '=', $escuela_id)
                ->where('nombre', 'like', '%'.$input.'%')
                ->get();

            if(!$professors_nombre->isEmpty()){
                foreach ($professors_nombre as $professor) {
                    $existe = false;
                    foreach ($professors as $professor_main) {
                        if($professor_main->id == $professor->id) {
                            $existe = true;
                        }
                    }

                    if(!$existe) {
                        array_push($professors, $professor);
                    }
                }
            }

            $professors_apellido = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where('escuela_id', '=', $escuela_id)
                ->where('apellido', 'like', '%'.$input.'%')
                ->get();

            if(!$professors_apellido->isEmpty()){
                foreach ($professors_apellido as $professor) {
                    $existe = false;
                    foreach ($professors as $professor_main) {
                        if($professor_main->id == $professor->id) {
                            $existe = true;
                        }
                    }

                    if(!$existe) {
                        array_push($professors, $professor);
                    }
                }
            }
        }

        return $professors;
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para asignar docentes, estudiantes y asesores
    public function allProfessorAsignaciones(Request $request){

        // Inicializar variables
        $escuela_id = auth()->user()->college_id;
        $input = $request->input;

        $professors = array();

        if($input == '') {

            $professors = DB::table('professors')
            ->select('id', 'codigo', 'nombre', 'apellido')
            ->where('escuela_id', '=', $escuela_id)
            ->get();

        } else {

            // Realizar consultas a la base de datos con las coindicencias del codigo de docente
            $professors_codigo = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where('escuela_id', '=', $escuela_id)
                ->where('codigo', 'like', '%'.$input.'%')
                ->get();

            if(!$professors_codigo->isEmpty()){
                foreach ($professors_codigo as $professor) {
                    array_push($professors, $professor);
                }
            }

            $professors_nombre = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where('escuela_id', '=', $escuela_id)
                ->where('nombre', 'like', '%'.$input.'%')
                ->get();

            if(!$professors_nombre->isEmpty()){
                foreach ($professors_nombre as $professor) {
                    $existe = false;
                    foreach ($professors as $professor_main) {
                        if($professor_main->id == $professor->id) {
                            $existe = true;
                        }
                    }

                    if(!$existe) {
                        array_push($professors, $professor);
                    }
                }
            }

            $professors_apellido = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where('escuela_id', '=', $escuela_id)
                ->where('apellido', 'like', '%'.$input.'%')
                ->get();

            if(!$professors_apellido->isEmpty()){
                foreach ($professors_apellido as $professor) {
                    $existe = false;
                    foreach ($professors as $professor_main) {
                        if($professor_main->id == $professor->id) {
                            $existe = true;
                        }
                    }

                    if(!$existe) {
                        array_push($professors, $professor);
                    }
                }
            }
        }

        return $professors;
    }
}
