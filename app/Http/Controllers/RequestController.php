<?php

namespace App\Http\Controllers;

use App\Professor;
use App\RequestApproved;
use App\RequestExtension;
use App\RequestName;
use App\RequestOfficial;
use App\RequestResult;
use App\RequestTribunal;
use App\Student;
use App\Tdg;
use App\TypeExtension;
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
                    ->get();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud[0]->tdg_id)
                    ->get();
            
                return view('solicitud.ver_aprobado', [
                    'tdg' => $tdg[0],
                    'solicitud' => $solicitud[0],
                ]);
                break;

            // Solicitud de oficializacion
            case 'oficializacion':
                $solicitud = RequestOfficial::select('*')
                    ->where('id', $id)
                    ->get();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud[0]->tdg_id)
                    ->get();
                return view('solicitud.ver_oficializacion', [
                    'tdg' => $tdg[0],
                    'solicitud' => $solicitud[0],
                ]);
                break;
                
            // Solicitud de cambio de nombre
            case 'cambio_de_nombre':
                $solicitud = RequestName::select('*')
                    ->where('id', $id)
                    ->get();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud[0]->tdg_id)
                    ->get();
                return view('solicitud.ver_cambioNombre', [
                    'tdg' => $tdg[0],
                    'solicitud' => $solicitud[0],
                ]);
                break;

            // Solicitud de prorroga (normal, extension y esepcial)
            case 'prorroga':
            case 'extension_de_prorroga':
            case 'prorroga_especial':
                $solicitud = RequestExtension::select('*')
                    ->where('id', $id)
                    ->get();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud[0]->tdg_id)
                    ->get();
                $tipoProrroga = TypeExtension::select('tipo')
                    ->where('id', $solicitud[0]->type_extension_id)
                    ->get()
                    [0]->tipo;;
                return view('solicitud.ver_prorroga', [
                    'tdg' => $tdg[0],
                    'solicitud' => $solicitud[0],
                    'tipoProrroga' => $tipoProrroga
                ]);
                break;

            // Solicitud de nombramiento de tribunal
            case 'nombramiento_de_tribunal':
                $solicitud = RequestTribunal::select('*')
                    ->where('id', $id)
                    ->get();
                $tdg = Tdg::select('*')
                    ->where('id', $solicitud[0]->tdg_id)
                    ->get();
                $docentes = DB::table('professor_request_tribunal')
                    ->select('professor_id')
                    ->where('request_tribunal_id', $id)
                    ->get();
                foreach($docentes as $docente){
                   $profesor = Professor::select('*')->where('id', $docente->professor_id)->get()->first();
                   $tribunal [] = $profesor->codigo . ' ' . $profesor->nombre . ' ' . $profesor->apellido;
                }
                return view('solicitud.ver_nombramientoTribunal', [
                    'tdg' => $tdg[0],
                    'solicitud' => $solicitud[0],
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
                        $resultados[] = $estudiante->carnet . ' ' . $estudiante->nombres . ' ' . $estudiante->apellidos . ' ' . $estudianteTDG->nota;
                    }
                    return view('solicitud.ver_ratificacionResultados', [
                        'tdg' => $tdg,
                        'solicitud' => $solicitud,
                        'resultados' => $resultados,
                    ]);
                    break;
     
        }

    }

}
