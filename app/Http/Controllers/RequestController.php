<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    // Consulta mediante AJAX para devolver todas las solicitudes de todos los TDG para el coordinador general
    public function allVerSolicitudesGeneral(Request $request) {

        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;
        $tipos_solicitudes = json_decode($request->tipo_solicitud);


        $solicitudes = array();

        $requests = array(['request_approveds', 'aprobado', 'Aprobado'], ['request_officials', 'oficializacion', 'Oficialización'], ['request_names', 'cambio_de_nombre', 'Cambio de nombre'], ['request_extensions', 'prorroga', 'Prórroga', '1'], ['request_extensions', 'extension_de_prorroga', 'Extensión de prórroga', '2'], ['request_extensions', 'prorroga_especial', 'Prórroga especial', '3'], ['request_tribunals', 'nombramiento_de_tribunal', 'Nombramiento de tribunal'], ['request_results', 'ratificacion_de_resultados', 'Ratificación de resultados']);

        for ($i=0; $i < sizeof($tipos_solicitudes); $i++) {

            foreach ($requests as $request) {

                if ($tipos_solicitudes[$i] == 'prorroga' || $tipos_solicitudes[$i] == 'extension_de_prorroga' || $tipos_solicitudes[$i] == 'prorroga_especial') {

                    if ($tipos_solicitudes[$i] == $request[1]) {

                        if (is_null($escuela_id)) {

                            $requests_data = DB::table($request[0])
                                ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                                ->select($request[0].'.id', 'tdgs.codigo', 'tdgs.nombre', $request[0].'.aprobado')
                                ->where('type_extension_id', '=', $request[3])
                                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                                ->get();
    
                        } else {
    
                            $requests_data = DB::table($request[0])
                                ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                                ->select($request[0].'.id', 'tdgs.codigo', 'tdgs.nombre', $request[0].'.aprobado')
                                ->where('type_extension_id', '=', $request[3])
                                ->where('tdgs.escuela_id', '=', $escuela_id)
                                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                                ->get();
    
                        }

                        if (!$requests_data->isEmpty()) {
            
                            foreach ($requests_data as $request_data) {
                                
                                $request_data->tipo_solicitud_url = $request[1];
                                $request_data->tipo_solicitud_nombre = $request[2];
    
                                $existe = false;
    
                                foreach ($solicitudes as $solicitud) {
                                    if ($request_data->id == $solicitud->id && $request_data->tipo_solicitud_url == $solicitud->tipo_solicitud_url) {
                                        $existe = true;
                                    }
                                }
    
                                if (!$existe) {

                                    if (is_null($request_data->aprobado)) {
                                        $request_data->aprobado = 'En trámite';
                                    } else if (empty($request_data->aprobado)) {
                                        $request_data->aprobado = 'Rechazado';
                                    } else if ($request_data->aprobado == 1) {
                                        $request_data->aprobado = 'Aprobado';
                                    }
                    
                                    array_push($solicitudes, $request_data);
                                }
                            }
            
                        }
                        
                    }                    

                } else {

                    if ($tipos_solicitudes[$i] == $request[1]) {
                        if (is_null($escuela_id)) {
    
                            $requests_data = DB::table($request[0])
                                ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                                ->select($request[0].'.id', 'tdgs.codigo', 'tdgs.nombre', $request[0].'.aprobado')
                                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                                ->get();
    
                        } else {
    
                            $requests_data = DB::table($request[0])
                                ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                                ->select($request[0].'.id', 'tdgs.codigo', 'tdgs.nombre', $request[0].'.aprobado')
                                ->where('tdgs.escuela_id', '=', $escuela_id)
                                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                                ->get();
    
                        }
    

                        if (!$requests_data->isEmpty()) {
            
                            foreach ($requests_data as $request_data) {

                                $request_data->tipo_solicitud_url = $request[1];
                                $request_data->tipo_solicitud_nombre = $request[2];
    
                                $existe = false;
    
                                foreach ($solicitudes as $solicitud) {
                                    if ($request_data->id == $solicitud->id && $request_data->tipo_solicitud_url == $solicitud->tipo_solicitud_url) {
                                        $existe = true;
                                    }
                                }
    
                                if (!$existe) {
                    
                                    if (is_null($request_data->aprobado)) {
                                        $request_data->aprobado = 'En trámite';
                                    } else if (empty($request_data->aprobado)) {
                                        $request_data->aprobado = 'Rechazado';
                                    } else if ($request_data->aprobado == 1) {
                                        $request_data->aprobado = 'Aprobado';
                                    }
                    
                                    array_push($solicitudes, $request_data);
                                }
                            }
            
                        }

                    }
                }
            }
        }

        return json_encode($solicitudes);
    }

}
