<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        //Permiso para mostrar la pantalla de formulario del ingreso de un perfil
        Permission::create([
            'name' => 'Ingresar TDG (formulario)',
            'slug' => 'tdg.ingresar',
            'description' => 'Formulario de ingreso de perfiles',
        ]);
        //Permiso que permite mandar a llamar el controller para el ingreso de un perfil
        Permission::create([
            'name' => 'Guardar TDG (llamando al controller)',
            'slug' => 'tdg.guardar',
            'description' => 'Ingresar nuevos perfiles al sistema',
        ]);

       
        ////Permiso para mostrar la pantalla de formulario del ingreso de un acuerdo
        Permission::create([
            'name' => 'Ingresar Acuerdo (formulario)',
            'slug' => 'agreement.ingresar',
            'description' => 'Formulario de ingreso de acuerdos',
        ]);
        //Permiso que permite mandar a llamar el controller para el ingreso de un acuerdo
        Permission::create([
            'name' => 'Ingresar Acuerdo (llamando al controller)',
            'slug' => 'agreement.guardar',
            'description' => 'Ingresar nuevos acuerdos al sistema',
        ]);


        //Permiso para mostrar la pantalla de formulario del ingreso de un ciclo
        Permission::create([
            'name' => 'Ingresar ciclo (formulario)',
            'slug' => 'semester.ingresar',
            'description' => 'Formulario de ingreso de inicio de ciclo',
        ]);
        //Permiso que permite mandar a llamar el controller para el ingreso de un ciclo
        Permission::create([
            'name' => 'Ingresar ciclo(llamando al controller)',
            'slug' => 'semester.guardar',
            'description' => 'Ingresar el ciclo al sistema',
        ]);
        
                //***********MAESTROS*************
        //Permiso para mostrar la pantalla para ingresar los maestros
        Permission::create([
            'name' => 'Ingresar maestros',
            'slug' => 'professor.ingresar',
            'description' => 'Formulario de ingreso de los maestros al sistema',
        ]);

        //Permiso que permite mandar a llamar el controller para el ingreso de maestro
        Permission::create([
            'name' => 'Ingresar maestros(llamando al controller1)',
            'slug' => 'professor.guardar',
            'description' => 'Ingresar maestros controlador',
        ]);
        Permission::create([
            'name' => 'Ingresar maestros(llamando al controller2)',
            'slug' => 'professor.guardarexcel',
            'description' => 'Ingresar maestros llamada por el excel',
        ]);

                //*************ALUMNOS***************
        //Permiso para mostrar la pantalla para ingresar los alumnos
        Permission::create([
            'name' => 'Ingresar alumnos',
            'slug' => 'student.ingresar',
            'description' => 'Formulario de ingreso de los alumnos al sistema',
        ]);

        //Permiso que permite mandar a llamar el controller para el ingreso de alumnos
        Permission::create([
            'name' => 'Ingresar alumnos(llamando al controller)',
            'slug' => 'student.guardar',
            'description' => 'Guardar los alumnos en el sistema',
        ]);

                 //*************SOLICITUDES***************
        //Permiso para mostrar la pantalla para la gestión de solicitudes
        Permission::create([
            'name' => 'Ingresar solicitudes',
            'slug' => 'solicitudes.listar',
            'description' => 'Listado de todas las solicitudes',
        ]);
        //Solicitud de cambio de nombre
        Permission::create([
            'name' => 'Ingresar solicitud de cambio de nombre',
            'slug' => 'request_name.ingresar',
            'description' => 'Solicitud de cambio de nombre ingresar',
        ]);
        Permission::create([
            'name' => 'Guardar solicitud de cambio de nombre',
            'slug' => 'name.guardar',
            'description' => 'Solicitud de cambio de nombre guardar',
        ]);
        //Solicitud de tribunal calificador
        Permission::create([
            'name' => 'Ingresar solicitud de tribunal',
            'slug' => 'request_tribunal.ingresar',
            'description' => 'Solicitud de cambio de tribunal ingresar',
        ]);
        Permission::create([
            'name' => 'Guardar solicitud de tribunal',
            'slug' => 'request_tribunal.guardar',
            'description' => 'Solicitud de cambio de tribunal guardar',
        ]);
        Permission::create([
            'name' => 'Guardar solicitud de tribunal profesores',
            'slug' => 'request_tribunal.guardarRequestTribunalProfessor',
            'description' => 'Solicitud de cambio de tribunal guardar profesores',
        ]);
            //Solicitud de prorrogas
        Permission::create([
            'name' => 'Ingresar solicitud de prorroga',
            'slug' => 'request_extension.ingresar',
            'description' => 'Solicitud de de prorroga ingresar',
        ]);
        Permission::create([
            'name' => 'Guardar solicitud de prorroga',
            'slug' => 'request_extension.guardar',
            'description' => 'Solicitud de prorroga guardar',
        ]);
        // Solicitud de ratificación de resultados
        Permission::create([
            'name' => 'Ingresar solicitud de resultados',
            'slug' => 'request_result.ingresar',
            'description' => 'Solicitud de resultados ingresar',
        ]);
        Permission::create([
            'name' => 'Guardar solicitud de resultados',
            'slug' => 'request_result.guardar',
            'description' => 'Solicitud de resultados guardar',
        ]);

         //*************RATIFICACIONES***************
        //Permiso para mostrar la pantalla para la gestión de ratificaciones
        Permission::create([
            'name' => 'Gestionar ratificaciones',
            'slug' => 'ratificar.listar',
            'description' => 'Listado de todas las solicitudes a ratificar',
        ]);
        
         //*************VER DETALLES***************
        //Permiso para mostrar la pantalla de ver detalles
        Permission::create([
            'name' => 'Ver detalles coordinador general',
            'slug' => 'tdg.filtroGestionarGeneral',
            'description' => 'Muestra los detalles de los tdgs',
        ]);
        Permission::create([
            'name' => 'Ver detalles coordinador de escuela',
            'slug' => 'tdg.filtroGestionarEscuela',
            'description' => 'Muestra los detalles de los tdgs',
        ]);
         //*************VER ACUERDOS**************
        //Permiso para mostrar la pantalla de ver acuerdos
        Permission::create([
            'name' => 'Ver los acuerdos',
            'slug' => 'agreement.listar_acuerdos',
            'description' => 'Muestra los acuerdos de JD',
        ]);

        //*************ASIGNAR GRUPO**************
        //Permiso para mostrar la pantalla de asignar grupo al tdg
        Permission::create([
            'name' => 'Asignar el grupo al tdg',
            'slug' => 'assignments.filtro',
            'description' => 'Muestra los acuerdos de JD',
        ]);
                //*************VER DETALLES RUTAS PRINCIPALES***************
        //Permiso para mostrar la pantalla de ver detalles
        Permission::create([
            'name' => 'Ver detalles coordinador de escuela',
            'slug' => 'tdg.todosTdgGestionarEscuela',
            'description' => 'Muestra los detalles de los tdgs',
        ]);
        Permission::create([
            'name' => 'Ver detalles coordinador general',
            'slug' => 'tdg.todosTdgGestionarGeneral',
            'description' => 'Muestra los detalles de los tdgs',
        ]);

        //*********RUTAS DE LAS PRORROGAS*****//
        Permission::create([
            'name' => 'Listar todas las prorrogas',
            'slug' => 'month.show',
            'description' => 'Muestra las prorrogas del sistema',
        ]);
        Permission::create([
            'name' => 'Editar la prroga',
            'slug' => 'month.edit',
            'description' => 'Permite editar el parametro de una prorroga',
        ]);
        Permission::create([
            'name' => 'Guarda el cambio de las prorrogas',
            'slug' => 'month.update',
            'description' => 'Guarda el cambio de las prorrogas en el sistema',
        ]);

        //***********RUTAS PARA MODIFICAR LOS USUARIOS******//
        Permission::create([
            'name' => 'Lista todos los usuarios',
            'slug' => 'user.index',
            'description' => 'Muestra los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Formulario para ingresar usuarios',
            'slug' => 'ingresar.usuario',
            'description' => 'Muestra el formulario para ingresar un usuario',
        ]);
        Permission::create([
            'name' => 'Guardar usuarios',
            'slug' => 'user.guardar',
            'description' => 'Guarda el usuarios en el sistema',
        ]);
        Permission::create([
            'name' => 'Formulario para editar usuarios',
            'slug' => 'user.edit',
            'description' => 'Muestra el formulario para editar usuarios en el sistema',
        ]);
        Permission::create([
            'name' => 'Guarda la información de los usuarios',
            'slug' => 'user.update',
            'description' => 'Edita la información en la base',
        ]);
        Permission::create([
            'name' => 'Ruta para la busqueda de usuarios',
            'slug' => 'user.show',
            'description' => 'Muestra la búsqueda de usuarios',
        ]);


        //*****RUTAS FALTANTES DE VER DETALLES******//
        Permission::create([
            'name' => 'Ruta para ver detalles coordinador escuela',
            'slug' => 'tdg.verDetalleTdgEscuela',
            'description' => 'Ver detalles coordinador escuela',
        ]);
        Permission::create([
            'name' => 'Ruta para ver detalles coordinador general',
            'slug' => 'tdg.verDetalleTdgGeneral',
            'description' => 'Ver detalles coordinador general',
        ]);

        //*******RUTAS FALTANTES PROFESORES****//
        Permission::create([
            'name' => 'Ruta para ver los profesores',
            'slug' => 'professor.index',
            'description' => 'Ver los profesores que estan en el sistema',
        ]);
        Permission::create([
            'name' => 'Ver los profesores',
            'slug' => 'professor.show',
            'description' => 'Ver los profesores',
        ]);
        Permission::create([
            'name' => 'Editar los profesores',
            'slug' => 'professor.edit',
            'description' => 'Editar los profesores del sistema',
        ]);
        Permission::create([
            'name' => 'Actualizar datos de los profesores',
            'slug' => 'professor.update',
            'description' => 'Actualizar los datos de los profesores del sistema',
        ]);

        //********RUTAS PARA LISTAR ESTUDIANTES */
        Permission::create([
            'name' => 'Listar todos los estudiantes',
            'slug' => 'student.index',
            'description' => 'Listar los estudiantes ingresados',
        ]);
        Permission::create([
            'name' => 'Ver todos los estudiantes',
            'slug' => 'student.show',
            'description' => 'Ver los estudiantes ingresados',
        ]);
        
        ///*****PERMISO PARA VER LAS VISTAS DE LAS SOLICITUDES**** */
        Permission::create([
            'name' => 'Ver el contenido de las solicitudes',
            'slug' => 'request.show',
            'description' => 'Información de las solicitudes',
        ]);

        //**RUTAS PARA VER LAS SOLICITUDES ******//
        Permission::create([
            'name' => 'Ver solicitudes coordinador general',
            'slug' => 'request.filtroVerSolicitudesGeneral',
            'description' => 'Pantalla para ver solicitudes coordinador general',
        ]);
        Permission::create([
            'name' => 'Ver solicitudes coordinador escuela',
            'slug' => 'request.filtroVerSolicitudesEscuela',
            'description' => 'Pantalla para ver solicitudes coordinador escuela',
        ]);

    }
}
