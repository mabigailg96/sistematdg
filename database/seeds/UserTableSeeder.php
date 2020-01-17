<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //




        User::create([
            'nombre'=> 'Admin',
            'username'=> 'admin',
            'email' => '1@gmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Civil',
            'username'=> 'civil',
            'college_id'=>'1',
            'email' => '2@gmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Industrial',
            'username'=> 'industrial',
            'college_id'=>'2',
            'email' => '3@gmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Mecanica',
            'username'=> 'mecanica',
            'college_id'=>'3',
            'email' => '3@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Electrica',
            'username'=> 'electrica',
            'college_id'=>'4',
            'email' => '4@gmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Quimica',
            'username'=> 'quimica',
            'college_id'=>'5',
            'email' => '5@gmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Alimentos',
            'username'=> 'alimentos',
            'college_id'=>'6',
            'email' => '6@gmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Sistemas',
            'username'=> 'sistemas',
            'college_id'=>'7',
            'email' => '7@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Arquitectura',
            'username'=> 'arquitectura',
            'college_id'=>'8',
            'email' => '8@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Posgrado',
            'username'=> 'posgrado',
            'college_id'=>'9',
            'email' => '9@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Civil',
            'username'=> 'secrecivil',
            'college_id'=>'1',
            'email' => 'secretaria1@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Industrial',
            'username'=> 'secreindustrial',
            'college_id'=>'2',
            'email' => 'secretaria2@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Mecánica',
            'username'=> 'secremecanica',
            'college_id'=>'3',
            'email' => 'secretaria3@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Eléctrica',
            'username'=> 'secreelectrica',
            'college_id'=>'4',
            'email' => 'secretaria4@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Quimica',
            'username'=> 'secrequimica',
            'college_id'=>'5',
            'email' => 'secretaria5@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Alimentos',
            'username'=> 'secrealimentos',
            'college_id'=>'6',
            'email' => 'secretaria6@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Sistemas',
            'username'=> 'secresistemas',
            'college_id'=>'7',
            'email' => 'secretaria7@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Arquitectura',
            'username'=> 'secrearquitectura',
            'college_id'=>'8',
            'email' => 'secretaria8@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Secretaria Posgrado',
            'username'=> 'secreposgrado',
            'college_id'=>'9',
            'email' => 'secretaria9@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Administración Académica',
            'username'=> 'academica',
            'email' => 'academica@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);


    }
}
