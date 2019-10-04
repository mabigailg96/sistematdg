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

    }
}
