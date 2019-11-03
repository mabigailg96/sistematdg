<?php

namespace App\Http\Controllers;

use App\Adviser;
use App\Professor;
use App\RequestApproved;
use App\RequestExtension;
use App\RequestName;
use App\RequestOfficial;
use App\RequestResult;
use App\RequestTribunal;
use App\Student;
use App\Tdg;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tipo_solicitud, $id)
    {
        switch($tipo_solicitud){
            // Solicitud de aprobado
            case 'aprobado':
                $solicitud = RequestApproved::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud->tdg_id)
                    ->get()
                    ->first();
            
                return view('solicitud.ver_aprobado', [
                    'tdg' => $tdg,
                    'solicitud' => $solicitud,
                    'tipoSolicitud' => $tipo_solicitud,
                ]);
                break;

            // Solicitud de oficializacion
            case 'oficializacion':
                $solicitud = RequestOfficial::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud->tdg_id)
                    ->get()
                    ->first();
                // Obteniendo Docente Director del TDG
                $docenteDirector = Professor::select('*')
                    ->where('id', $tdg->profesor_id)
                    ->select()
                    ->first();
                // Obteniendo estudiantes del TDG
                $estdudiantesTDG = DB::table('student_tdg')
                    ->select('student_id')
                    ->where('tdg_id',$tdg->id)
                    ->get();
                foreach($estdudiantesTDG as $estudianteTDG){
                    $estudiante = Student::select('*')
                        ->where('id', $estudianteTDG->student_id)
                        ->get()
                        ->first();
                    $estudiantes[] = (object) [
                        'carnet' => $estudiante->carnet,
                        'nombre' => $estudiante->nombres . ' ' . $estudiante->apellidos,
                    ];
                }
                // Obteniendo asesores internos del TDG
                $profesoresTDG = DB::table('professor_tdg')
                    ->select('*')
                    ->where('tdg_id', $tdg->id)
                    ->get();
                foreach($profesoresTDG as $profesorTDG){
                    $profesor = Professor::select('*')
                        ->where('id', $profesorTDG->professor_id)
                        ->get()
                        ->first();
                    $asesoresInternos[] = (object) [
                        'codigo' => $profesor->codigo,
                        'nombre' => $profesor->nombre . ' ' . $profesor->apellido,
                    ];
                }
                // Obteniendo asesores externos del TDG
                $asesoresExternos = array();
                $asesoresTDG = DB::table('adviser_tdg')
                    ->select('adviser_id')
                    ->where('tdg_id', $tdg->id)
                    ->get();
                foreach($asesoresTDG as $asesorTDG){
                    $asesor = Adviser::select('*')
                        ->where('id', $asesorTDG->adviser_id)
                        ->get()
                        ->first();
                    $asesoresExternos[] = $asesor->nombre . ' ' . $asesor->apellido;
                }
                return view('solicitud.ver_oficializacion', [
                    'tdg' => $tdg,
                    'solicitud' => $solicitud,
                    'tipoSolicitud' => $tipo_solicitud,
                    'docenteDirector' => $docenteDirector->nombre . ' ' . $docenteDirector->apellido,
                    'estudiantes' => $estudiantes,
                    'asesoresInternos' => $asesoresInternos,
                    'asesoresExternos' => $asesoresExternos,
                ]);
                break;
                
            // Solicitud de cambio de nombre
            case 'cambio_de_nombre':
                $solicitud = RequestName::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud->tdg_id)
                    ->get()
                    ->first();
                return view('solicitud.ver_cambioNombre', [
                    'tdg' => $tdg,
                    'solicitud' => $solicitud,
                    'tipoSolicitud' => $tipo_solicitud,
                ]);
                break;

            // Solicitud de prorroga (normal, extension y esepcial)
            case 'prorroga':
            case 'extension_de_prorroga':
            case 'prorroga_especial':
                $solicitud = RequestExtension::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud->tdg_id)
                    ->get()
                    ->first();
                switch($tipo_solicitud){
                    case 'prorroga':
                        $tipoProrroga = 'Prórroga';
                        break;
                    case 'extension_de_prorroga':
                        $tipoProrroga = 'Extensión de Prórroga';
                        break;
                    case 'prorroga_especial':
                        $tipoProrroga = 'Prórroga especial';
                        break;
                        
                }
                return view('solicitud.ver_prorroga', [
                    'tdg' => $tdg,
                    'solicitud' => $solicitud,
                    'tipoSolicitud' => $tipo_solicitud,
                    'tipoProrroga' => $tipoProrroga,
                ]);
                break;

            // Solicitud de nombramiento de tribunal
            case 'nombramiento_de_tribunal':
                $solicitud = RequestTribunal::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud->tdg_id)
                    ->get()
                    ->first();
                $docentes = DB::table('professor_request_tribunal')
                    ->select('professor_id')
                    ->where('request_tribunal_id', $id)
                    ->get();
                foreach($docentes as $docente){
                   $profesor = Professor::select('*')->where('id', $docente->professor_id)->get()->first();
                   $tribunal [] = $profesor->codigo . ' ' . $profesor->nombre . ' ' . $profesor->apellido;
                }
                return view('solicitud.ver_nombramientoTribunal', [
                    'tdg' => $tdg,
                    'solicitud' => $solicitud,
                    'tipoSolicitud' => $tipo_solicitud,
                    'tribunal' => $tribunal,
                ]);
                break;

                case 'ratificacion_de_resultados':
                    $solicitud = RequestResult::select('*')
                        ->where('id', $id)
                        ->get()
                        ->first();
                    $tdg = Tdg::select('*')
                        ->where('id', $solicitud->tdg_id)
                        ->get()
                        ->first();
                    $estudiantesTDG = DB::table('student_tdg')
                        ->select('*')
                        ->where('tdg_id', $tdg->id)
                        ->get();
                    foreach ($estudiantesTDG as $estudianteTDG){
                        $estudiante = Student::select('*')
                            ->where('id', $estudianteTDG->student_id)
                            ->select()
                            ->first();
                        $resultados[] = (object)[
                            'carnet' => $estudiante->carnet,
                            'nombre' => $estudiante->nombres . ' ' . $estudiante->apellidos,
                            'nota' => $estudianteTDG->nota,
                        ];
                    }
                    return view('solicitud.ver_ratificacionResultados', [
                        'tdg' => $tdg,
                        'solicitud' => $solicitud,
                        'tipoSolicitud' => $tipo_solicitud,
                        'resultados' => $resultados,
                    ]);
                    break;
     
        }

    }

}
