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
            'email' => 'admin@admin.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Civil',
            'username'=> 'civil',
            'college_id'=>'1',
            'email' => '1@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Industrial',
            'username'=> 'industrial',
            'college_id'=>'2',
            'email' => '2@hotmail.com',
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
            'email' => '4@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Quimica',
            'username'=> 'quimica',
            'college_id'=>'5',
            'email' => '5@hotmail.com',
            'password'=> bcrypt('1234'),

        ]);
        User::create([
            'nombre'=> 'Ing. Alimentos',
            'username'=> 'alimentos',
            'college_id'=>'6',
            'email' => '6@hotmail.com',
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
        
    }
}
