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
use Caffeinated\Shinobi\Models\Role;
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
                    ->where('tdg_id', $id)
                    ->where('aprobado', null)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $id)
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
                    ->where('tdg_id', $id)
                    ->where('aprobado', null)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $id)
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
                    ->where('tdg_id',$id)
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
                $asesoresInternos = array();
                $profesoresTDG = DB::table('professor_tdg')
                    ->select('*')
                    ->where('tdg_id', $id)
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
                    ->where('tdg_id', $id)
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
                    ->where('tdg_id', $id)
                    ->where('aprobado', null)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $id)
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
                    ->where('tdg_id', $id)
                    ->where('aprobado', null)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $id)
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
                    ->where('tdg_id', $id)
                    ->where('aprobado', null)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $docentes = DB::table('professor_request_tribunal')
                    ->select('professor_id')
                    ->where('request_tribunal_id', $solicitud->id)
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

            // Solicitud de ratificacion de resultados
            case 'ratificacion_de_resultados':
                $solicitud = RequestResult::select('*')
                    ->where('tdg_id', $id)
                    ->where('aprobado', null)
                    ->get()
                    ->first();
                $tdg = Tdg::select('*')
                    ->where('id', $id)
                    ->get()
                    ->first();
                $estudiantesTDG = DB::table('student_tdg')
                    ->select('*')
                    ->where('tdg_id', $id)
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

    // Método para ver el detalle de una solicitud
    public function showVerSolicitud($tipo_solicitud, $id)
    {    

        // Comprobar si es usuario logueado es coordinador general o de escuela

        $user_id = auth()->user()->id;

        $consulta_datos = DB::table('role_user')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('role_user.role_id', 'roles.name', 'roles.slug')
            ->where('role_user.user_id', '=', $user_id)
            ->get();

        $rol = $consulta_datos[0]->slug;

        $requests = array(['request_approveds', 'aprobado', 'Aprobado'], ['request_officials', 'oficializacion', 'Oficialización'], ['request_names', 'cambio_de_nombre', 'Cambio de nombre'], ['request_extensions', 'prorroga', 'Prórroga', '1'], ['request_extensions', 'extension_de_prorroga', 'Extensión de prórroga', '2'], ['request_extensions', 'prorroga_especial', 'Prórroga especial', '3'], ['request_tribunals', 'nombramiento_de_tribunal', 'Nombramiento de tribunal'], ['request_results', 'ratificacion_de_resultados', 'Ratificación de resultados']);
        
        foreach ($requests as $request) {

            if ($tipo_solicitud == 'prorroga' || $tipo_solicitud == 'extension_de_prorroga' || $tipo_solicitud == 'prorroga_especial') {

                if ($request[1] == $tipo_solicitud) {
                    $requests_data = DB::table($request[0])
                        ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                        ->select($request[0].'.tdg_id', 'tdgs.codigo', 'tdgs.nombre', $request[0].'.aprobado', $request[0].'.fecha', $request[0].'.fecha_inicio', $request[0].'.fecha_fin', $request[0].'.justificacion', $request[0].'.url_documento_solicitud')
                        ->where($request[0].'.type_extension_id', '=', $request[3])
                        ->where($request[0].'.id', '=', $request[3])
                        ->get();
                    
                    return view('solicitudesVer.ver_prorrogas', [
                        'solicitud' => $requests_data[0],
                        'tipoProrroga' => $request[2],
                        'tipoSolicitud' => $tipo_solicitud,
                        'rol' => $rol,
                    ]);
                }

            } else {

                if ($request[1] == $tipo_solicitud) {

                    $requests_data = DB::table($request[0])
                        ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                        ->select($request[0].'.tdg_id', 'tdgs.codigo', 'tdgs.nombre', 'tdgs.profesor_id', $request[0].'.fecha')
                        ->where($request[0].'.id', '=', $id)
                        ->get();

                    if (!$requests_data->isEmpty()) {
                        
                        if ($tipo_solicitud == 'aprobado') {

                            return view('solicitudesVer.ver_aprobados', [
                                'solicitud' => $requests_data[0],
                                'tipoSolicitud' => $tipo_solicitud,
                                'rol' => $rol,
                            ]);

                        } elseif ($tipo_solicitud == 'oficializacion') {

                            // Obtener datos del docente director
                            $docente_director = DB::table('tdgs')
                                ->join('professors', 'tdgs.profesor_id', '=', 'professors.id')
                                ->select('professors.nombre', 'professors.apellido')
                                ->where('tdgs.id', '=', $requests_data[0]->tdg_id)
                                ->get();
                            
                            // Obtener estudiantes
                            $estudiantes = DB::table('student_tdg')
                                ->join('students', 'student_tdg.student_id', '=', 'students.id')
                                ->select('student_tdg.id as student_tdg_id', 'students.id', 'students.carnet', 'students.nombres', 'students.apellidos', 'student_tdg.activo')
                                ->where('student_tdg.tdg_id', '=', $requests_data[0]->tdg_id)
                                ->get();
                            
                            // Obtener asesores internos
                            $asesores_internal = DB::table('professor_tdg')
                                ->join('professors', 'professor_tdg.professor_id', '=', 'professors.id')
                                ->select('professors.id', 'professors.codigo', 'professors.nombre', 'professors.apellido')
                                ->where('professor_tdg.tdg_id', '=', $requests_data[0]->tdg_id)
                                ->get();

                            // Obtener asesores externos
                            $asesores_external = DB::table('adviser_tdg')
                                ->join('advisers', 'adviser_tdg.adviser_id', '=', 'advisers.id')
                                ->select('advisers.id', 'advisers.nombre', 'advisers.apellido')
                                ->where('adviser_tdg.tdg_id', '=', $requests_data[0]->tdg_id)
                                ->get();


                            return view('solicitudesVer.ver_oficializaciones', [
                                'solicitud' => $requests_data[0],
                                'tipoSolicitud' => $tipo_solicitud,
                                'docenteDirector' => $docente_director[0]->nombre . ' ' . $docente_director[0]->apellido,
                                'estudiantes' => $estudiantes,
                                'asesoresInternos' => $asesores_internal,
                                'asesoresExternos' => $asesores_external,
                                'rol' => $rol,
                            ]);

                        } elseif ($tipo_solicitud == 'cambio_de_nombre') {

                            $requests_data = DB::table($request[0])
                                ->join('tdgs', $request[0].'.tdg_id','=', 'tdgs.id')
                                ->select($request[0].'.tdg_id', 'tdgs.codigo', 'tdgs.nombre', $request[0].'.fecha', $request[0].'.nuevo_nombre', $request[0].'.justificacion')
                                ->where($request[0].'.id', '=', $id)
                                ->get();
                            
                            return view('solicitudesVer.ver_cambio_nombre', [
                                'solicitud' => $requests_data[0],
                                'tipoSolicitud' => $tipo_solicitud,
                                'rol' => $rol,
                            ]);

                        } elseif ($tipo_solicitud == 'nombramiento_de_tribunal') {

                            $professors_requests_tribunals = DB::table('professor_request_tribunal')
                                ->join($request[0], 'professor_request_tribunal.request_tribunal_id', '=', $request[0].'.id')
                                ->select('professor_request_tribunal.professor_id')
                                ->where('professor_request_tribunal.request_tribunal_id', '=', $id)
                                ->get();

                            $tribunal = array();

                            foreach ($professors_requests_tribunals as $professor_request_tribunal) {

                                $professor = DB::table('professors')
                                    ->select('id', 'codigo', 'nombre', 'apellido')
                                    ->where('id', '=', $professor_request_tribunal->professor_id)
                                    ->get();

                                array_push($tribunal, $professor[0]);
                            }

                            return view('solicitudesVer.ver_nombramiento_tribunal', [
                                'solicitud' => $requests_data[0],
                                'tipoSolicitud' => $tipo_solicitud,
                                'tribunal' => $tribunal,
                                'rol' => $rol,
                            ]);

                        } elseif ($tipo_solicitud == 'ratificacion_de_resultados') {

                            $resultados = DB::table('student_tdg')
                                ->join('students', 'student_tdg.student_id', '=', 'students.id')
                                ->select('students.id', 'students.carnet', 'students.nombres', 'students.apellidos', 'student_tdg.nota')
                                ->where('student_tdg.tdg_id', '=', $requests_data[0]->tdg_id)
                                ->get();

                            return view('solicitudesVer.ver_ratificacion_resultados', [
                                'solicitud' => $requests_data[0],
                                'tipoSolicitud' => $tipo_solicitud,
                                'resultados' => $resultados,
                                'rol' => $rol,
                            ]);

                        }
                        

                    }
                }

            }
        }
    }

}
