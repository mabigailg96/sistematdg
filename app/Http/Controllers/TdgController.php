<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tdg;
use \DB;
use SebastianBergmann\Environment\Console;

class TdgController extends Controller
{
    //

    public function create()
    {
        $ciclos = new SemesterController();

        return view('tdg.ingresar', ['ciclos' => $ciclos->viewSemesters()]);
    }

    public function store(Request $request)
    {
        $perfil = $request->validate([
            'nombre' => 'required|unique:tdgs',
            'perfil' => 'required|unique:tdgs',
            'ciclo_id' => 'required',
        ]);

        // Rescatando el ciclo a que pertenece el tdg
        $ciclo_request = $request->Input('ciclo_id');
        $ciclo_id = (int) $ciclo_request;

        //Rescatar escuela del usuario
        $escuela_request = $request->Input('college_id');
        $escuela_id = (int) $escuela_request;

        //Rescatando el ultimo tdgs ingresado en la base de datos.
        $lastTdg = DB::table('tdgs')->where('escuela_id', '=', $escuela_id)->orderBy('id', 'DESC')->first();
        //psi19001
        if ($lastTdg == null) {
            $lastCorrelativo = 0;
        } else {
            //Partiendo el codigo del TDG para solo extraer el correlativo.
            $lastCorrelativo = (int) substr($lastTdg->codigo, strlen($lastTdg->codigo) - 3, strlen($lastTdg->codigo));
        }

        //Hacer codigo de TDG

        //Obteniendo la escuela.
        $escuela = DB::table('colleges')->find($escuela_id);
        $correlativo = '';

        //Verificando el ultimo id, para completar el correlativo.
        if ($lastCorrelativo <= 9) {
            $correlativo = '00';
        }
        if ($lastCorrelativo > 9 && $lastCorrelativo <= 99) {
            $correlativo = '0';
        }

        //Nuevo codigo TDG
        $codigo = 'P' . $escuela->nombre . date("y") . $correlativo . ($lastCorrelativo + 1);

        //Guardar archivos
        $file = $request->file('perfil');

        //obtenemos el nombre del archivo
        $nombre_archivo = $file->getClientOriginalName();

        //Obtenemos todos los TDG para verificar que el nombre del archivo no exista.
        $existeTDG = DB::table('tdgs')
            ->select('perfil')
            ->get();


        $existe = 0;
        if ($existeTDG) {
            //Verificando que el nombre del archivo no exista.
            foreach ($existeTDG as $oldTdg) {
                if ($oldTdg->perfil == $nombre_archivo)
                    $existe = 1;
            }
        }

        //Si no se encuentra ya ese archivo registrado se guarda el perfil.
        if ($existe == 0) {
            \Storage::disk('localp')->put($nombre_archivo,  \File::get($file));

            //Guardarmos el TDG.
            $tdg = Tdg::create([
                'nombre' => $perfil['nombre'],
                'escuela_id' => $escuela_id,
                'codigo' => $codigo,
                'perfil' => $nombre_archivo,
                'ciclo_id' => $ciclo_id,
            ]);

            return redirect()->route('tdg.ingresar', '/?' . $tdg->id . '&save=1')
                ->with('info', 'Trabajo de graduación guardado con éxito');
        } else {
            return redirect()->route('tdg.ingresar', '/?&save=0&nombre=' . $perfil['nombre'])
                ->with('info', 'El nombre del perfil ya existe. Por favor cambie el nombre del archivo');
        }
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para solicitudes
    public function allTdgSolicitudes(Request $request){
        
        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;
        $tipo_solicitud = '';
        $tipo_solicitud = $request->tipo_solicitud;

        // Realizar consultas a la base de datos

        $tdgs = '';
        if($tipo_solicitud == 'cambio_de_nombre'){
            $tdgs = DB::table('tdgs')
                ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.estado_oficial', '<>', 'Abandonado')
                ->where('tdgs.estado_oficial', '<>', 'Aprobado')
                ->where('tdgs.estado_oficial', '<>', 'Finalizado')
                ->where('tdgs.estado_oficial', '<>', 'Tribunal')
                ->where('tdgs.estado_oficial', '<>', 'Resultados')
                ->get();
        } else if($tipo_solicitud == 'prorroga'){
            $tdgs = DB::table('tdgs')
                ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.estado_oficial', '<>', 'Prórroga')
                ->where('tdgs.estado_oficial', '<>', 'Extensión de prórroga')
                ->where('tdgs.estado_oficial', '<>', 'Prórroga especial')
                ->where('tdgs.estado_oficial', '<>', 'Abandonado')
                ->where('tdgs.estado_oficial', '<>', 'Aprobado')
                ->where('tdgs.estado_oficial', '<>', 'Finalizado')
                ->get();
        } else if($tipo_solicitud == 'extension_de_prorroga'){
            $tdgs = DB::table('tdgs')
                ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.estado_oficial', '=', 'Prórroga')
                ->get();
        } else if($tipo_solicitud == 'prorroga_especial'){
            $tdgs = DB::table('tdgs')
                ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.estado_oficial', '=', 'Extensión de prórroga')
                ->get();
        } else if($tipo_solicitud == 'nombramiento_de_tribunal'){
            $tdgs = DB::table('tdgs')
                ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.estado_oficial', '<>', 'Abandonado')
                ->where('tdgs.estado_oficial', '<>', 'Aprobado')
                ->where('tdgs.estado_oficial', '<>', 'Finalizado')
                ->where('tdgs.estado_oficial', '<>', 'Resultados')
                ->where('tdgs.estado_oficial', '<>', 'Tribunal')
                ->get();
        }else if($tipo_solicitud == 'ratificacion_de_resultado'){
            $tdgs = DB::table('tdgs')
                ->join('semesters', 'tdgs.ciclo_id', '=', 'semesters.id')
                ->select('tdgs.id', 'tdgs.codigo', 'tdgs.nombre', 'semesters.ciclo')
                ->where('tdgs.escuela_id', '=', $escuela_id)
                ->where('tdgs.codigo', 'like', '%'.$codigo.'%')
                ->where('tdgs.nombre', 'like', '%'.$nombre.'%')
                ->where('tdgs.estado_oficial', '<>', 'Abandonado')
                ->where('tdgs.estado_oficial', '<>', 'Aprobado')
                ->where('tdgs.estado_oficial', '<>', 'Finalizado')
                ->where('tdgs.estado_oficial', '=', 'Tribunal')
                ->where('tdgs.estado_oficial', '<>', 'Resultados')
                ->get();
        }

        return $tdgs;
    }

    // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para asignar docentes, estudiantes y asesores
    public function allTdgAsignaciones(Request $request){
        
        // Inicializar variables
        $escuela_id = '';
        $escuela_id = $request->escuela_id;
        $codigo = '';
        $codigo = $request->codigo;
        $nombre = '';
        $nombre = $request->nombre;

        // Realizar consultas a la base de datos
        $tdgs = DB::table('tdgs')
            ->select('id', 'codigo', 'nombre')
            ->where('escuela_id', '=', $escuela_id)
            ->where('codigo', 'like', '%'.$codigo.'%')
            ->where('nombre', 'like', '%'.$nombre.'%')
            ->get();

        return $tdgs;
    }

        // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para gestionar tdg por coordinador de escuela
        public function allTdgGestionarEscuela(Request $request){
        
            // Inicializar variables
            $escuela_id = '';
            $escuela_id = $request->escuela_id;
            $estado_oficial = '';
            $estado_oficial = $request->estado_oficial;
            $codigo = '';
            $codigo = $request->codigo;
            $nombre = '';
            $nombre = $request->nombre;

            // Realizar consultas a la base de datos
            if ($request->estado_oficial == null) {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->where('escuela_id', '=', $escuela_id)
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->get();

            } else if ($request->estado_oficial == 'Recien ingresado') {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->where('escuela_id', '=', $escuela_id)
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->whereNull('estado_oficial')
                    ->get();

            } else if ($request->estado_oficial != 'Recien ingresado' && $request->estado_oficial != null) {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->where('escuela_id', '=', $escuela_id)
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->where('estado_oficial', '=', $estado_oficial)
                    ->get();

            }
    
            return $tdgs;
        }

        // Está función se consulta mediante ajax para traer los TDG filtrados por escuela, codigo y nombre para gestionar tdg por coordinador de escuela
        public function allTdgGestionarGeneral(Request $request){
        
            // Inicializar variables
            $escuela_id = '';
            $escuela_id = $request->escuela_id;
            $estado_oficial = '';
            $estado_oficial = $request->estado_oficial;
            $codigo = '';
            $codigo = $request->codigo;
            $nombre = '';
            $nombre = $request->nombre;

            // Realizar consultas a la base de datos
            if ($request->escuela_id == null && $request->estado_oficial == null) {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->get();

            } else if ($request->escuela_id == null && $request->estado_oficial == 'Recien ingresado') {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->whereNull('estado_oficial')
                    ->get();

            } else if ($request->escuela_id != null && $request->estado_oficial == null) {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->where('escuela_id', '=', $escuela_id)
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->get();

            } else if ($request->escuela_id != null && $request->estado_oficial == 'Recien ingresado') {

                $tdgs = DB::table('tdgs')
                    ->select('id', 'codigo', 'nombre', 'estado_oficial')
                    ->where('escuela_id', '=', $escuela_id)
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->whereNull('estado_oficial')
                    ->get();

            } else if ($request->escuela_id == null && $request->estado_oficial != 'Recien ingresado' && $request->estado_oficial != null) {

                $tdgs = DB::table('tdgs')
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->where('estado_oficial', '=', $estado_oficial)
                    ->get();

            } else if ($request->escuela_id != null && $request->estado_oficial != 'Recien ingresado' && $request->estado_oficial != null) {

                $tdgs = DB::table('tdgs')
                    ->where('escuela_id', '=', $escuela_id)
                    ->where('codigo', 'like', '%'.$codigo.'%')
                    ->where('nombre', 'like', '%'.$nombre.'%')
                    ->where('estado_oficial', '=', $estado_oficial)
                    ->get();
                    
            }
    
            return $tdgs;
        }
}
