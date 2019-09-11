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



        

    }
}
