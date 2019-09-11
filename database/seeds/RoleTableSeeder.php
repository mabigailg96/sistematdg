<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=> 'Coordinador General',
            'slug'=> 'coorgen',
        ]);

        Role::create([
            'name'=> 'Coordinador de Escuela',
            'slug'=> 'cooresc',
        ]);

        Role::create([
            'name'=> 'Secretaria de Escuela',
            'slug'=> 'secres',
        ]);

        Role::create([
            'name'=> 'Administracion academica',
            'slug'=> 'academica',
        ]);


    }
}
