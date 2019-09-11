<?php

use Illuminate\Database\Seeder;
use App\College;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        College::create([
            'codigo'=> '1',
            'nombre'=> 'CI',
            'nombre_completo'=>'Civil',
            
        ]);
        College::create([
            'codigo'=> '2',
            'nombre'=> 'IN',
            'nombre_completo'=>'Industrial',
        ]);
        College::create([
            'codigo'=> '3',
            'nombre'=> 'ME',
            'nombre_completo'=>'Mecánica',
        ]);
        College::create([
            'codigo'=> '4',
            'nombre'=> 'EL',
            'nombre_completo'=>'Eléctrica',
        ]);
        College::create([
            'codigo'=> '5',
            'nombre'=> 'QU',
            'nombre_completo'=>'Química',
        ]);
        College::create([
            'codigo'=> '6',
            'nombre'=> 'AL',
            'nombre_completo'=>'Alimentos',
        ]);
        College::create([
            'codigo'=> '7',
            'nombre'=> 'SI',
            'nombre_completo'=>'Sistemas Informáticos',
        ]);
        College::create([
            'codigo'=> '8',
            'nombre'=> 'AR',
            'nombre_completo'=>'Arquitectura',
        ]);
        College::create([
            'codigo'=> '9',
            'nombre'=> 'PO',
            'nombre_completo'=>'Posgrado',
        ]);
    }
}
