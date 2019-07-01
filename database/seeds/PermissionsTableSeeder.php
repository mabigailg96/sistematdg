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
        //**************Trabajos de graduacion**********************

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

        //***************Acuerdos de Junta Directiva
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

    }
}
