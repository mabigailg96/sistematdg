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
        $apellido_profesor =   '';
        $apellido_profesor =   $request->apellido;
        $codigo_profesor =   '';
        $codigo_profesor =   $request->codigo;
        $escuela_profesor =   '';
        $escuela_profesor =  auth()->user()->college_id;



        //Realizando la consulta a la base de datos para obtener los acuerdos
        $usuarios = DB::table('professors')
        ->select('id','codigo', 'nombre', 'apellido','estado')
        ->where('nombre', 'like', '%'.$nombre_profesor.'%')
        ->where('apellido', 'like', '%'.$apellido_profesor.'%')
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

        $arreglo = explode(' ', $input);

        for ($i=0; $i < sizeof($arreglo); $i++) {

            $professors_query = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where(DB::raw('CONCAT(codigo, ", ", nombre, " ", apellido)'), 'like', '%'.$arreglo[$i].'%')
                ->where('escuela_id', '=', $escuela_id)
                ->where('estado', '=', '1')
                ->get();

            if (!$professors_query->isEmpty()){

                $existe = false;

                foreach ($professors_query as $professor_query) {

                    foreach ($professors as $professor) {
                        if ($professor_query->id == $professor->id) {
                            $existe = true;
                        }
                    }

                    if (!$existe) {
                        array_push($professors, $professor_query);
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

        $arreglo = explode(' ', $input);

        for ($i=0; $i < sizeof($arreglo); $i++) {

            $professors_query = DB::table('professors')
                ->select('id', 'codigo', 'nombre', 'apellido')
                ->where(DB::raw('CONCAT(codigo, ", ", nombre, " ", apellido)'), 'like', '%'.$arreglo[$i].'%')
                ->where('escuela_id', '=', $escuela_id)
                ->where('estado', '=', '1')
                ->get();

            if (!$professors_query->isEmpty()){

                $existe = false;

                foreach ($professors_query as $professor_query) {

                    foreach ($professors as $professor) {
                        if ($professor_query->id == $professor->id) {
                            $existe = true;
                        }
                    }

                    if (!$existe) {
                        array_push($professors, $professor_query);
                    }
                }
            }
        }

        return $professors;
    }
}
