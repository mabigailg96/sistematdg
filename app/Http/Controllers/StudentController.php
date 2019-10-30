<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use \DB;

class StudentController extends Controller
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
        return view('student.ingresar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'file'=>'required|mimes:xls,xlsx',
            'escuela_id'=>'required',
        ]);

        $idEscuela = $request['escuela_id'];
        
        try {
            Excel::import(new StudentsImport($idEscuela), request()->file('file'));
        } catch (\Exception $ex) {
            return redirect()->route('student.ingresar','/?save=0')->with('info', 'Los estudiantes no han sido guardados');
        }

        return redirect()->route('student.ingresar','/?save=1')->with('info', 'Los estudiantes han sido guardados con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, carnet y nombre para asignar docentes, estudiantes y asesores
    public function allStudentAsignaciones(Request $request){
        
        // Inicializar variables
        $escuela_id = auth()->user()->college_id;
        $input = $request->input;

        $students = array();

        if($input == '') {

            $students = DB::table('students')
                ->leftJoin('student_tdg', 'student_tdg.student_id', '=', 'students.id')
                ->select('students.id', 'students.carnet', 'students.nombres', 'students.apellidos')
                ->where('student_tdg.student_id', '=', NULL)
                ->where('students.escuela_id', '=', $escuela_id)
                ->get();

        } else {

            // Realizar consultas a la base de datos con las coindicencias del carnet del estudiante
            $students_carnet = DB::table('students')
                ->leftJoin('student_tdg', 'student_tdg.student_id', '=', 'students.id')
                ->select('students.id', 'students.carnet', 'students.nombres', 'students.apellidos')
                ->where('student_tdg.student_id', '=', NULL)
                ->where('students.escuela_id', '=', $escuela_id)
                ->where('students.carnet', 'like', '%'.$input.'%')
                ->get();

            if(!$students_carnet->isEmpty()){
                foreach ($students_carnet as $student) {
                    array_push($students, $student);
                }
            }

            $students_nombres = DB::table('students')
                ->leftJoin('student_tdg', 'student_tdg.student_id', '=', 'students.id')
                ->select('students.id', 'students.carnet', 'students.nombres', 'students.apellidos')
                ->where('student_tdg.student_id', '=', NULL)
                ->where('students.escuela_id', '=', $escuela_id)
                ->where('students.nombres', 'like', '%'.$input.'%')
                ->get();

            if(!$students_nombres->isEmpty()){
                foreach ($students_nombres as $student) {
                    $existe = false;
                    foreach ($students as $student_main) {
                        if($student_main->id == $student->id) {
                            $existe = true;
                        }
                    }

                    if(!$existe) {
                        array_push($students, $student);
                    }
                }
            }

            $students_apellidos = DB::table('students')
                ->leftJoin('student_tdg', 'student_tdg.student_id', '=', 'students.id')
                ->select('students.id', 'students.carnet', 'students.nombres', 'students.apellidos')
                ->where('student_tdg.student_id', '=', NULL)
                ->where('students.escuela_id', '=', $escuela_id)
                ->where('students.apellidos', 'like', '%'.$input.'%')
                ->get();

            if(!$students_apellidos->isEmpty()){
                foreach ($students_apellidos as $student) {
                    $existe = false;
                    foreach ($students as $student_main) {
                        if($student_main->id == $student->id) {
                            $existe = true;
                        }
                    }

                    if(!$existe) {
                        array_push($students, $student);
                    }
                }
            }
        }

        return $students;
    }

    // Está función me devuelve las coincidencias para los estudiantes con respecto a su nombre y apellido
    public function allStudentNombreApellido($estudiante){

        $students = array();
        
        $arreglo = explode(' ', $estudiante);

        for ($i=0; $i < sizeof($arreglo); $i++) { 

            $students_query = DB::table('students')
                ->select('id')
                ->where(DB::raw('CONCAT(nombres, " ", apellidos)'), 'like', '%'.$arreglo[$i].'%')
                ->get();

            if (!$students_query->isEmpty()){

                $existe = false;
                
                foreach ($students_query as $student_query) {
                    
                    foreach ($students as $student) {
                        if ($student_query->id == $student->id) {
                            $existe = true;
                        }
                    }

                    if (!$existe) {
                        array_push($students, $student_query);
                    }
                }
            }
        }

        return $students;
    }
}
