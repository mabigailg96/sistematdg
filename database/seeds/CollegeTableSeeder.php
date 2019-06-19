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
        ]);
        College::create([
            'codigo'=> '2',
            'nombre'=> 'IN',
        ]);
        College::create([
            'codigo'=> '3',
            'nombre'=> 'ME',
        ]);
        College::create([
            'codigo'=> '4',
            'nombre'=> 'EL',
        ]);
        College::create([
            'codigo'=> '5',
            'nombre'=> 'QU',
        ]);
        College::create([
            'codigo'=> '6',
            'nombre'=> 'AL',
        ]);
        College::create([
            'codigo'=> '7',
            'nombre'=> 'SI',
        ]);
        College::create([
            'codigo'=> '8',
            'nombre'=> 'AR',
        ]);
        College::create([
            'codigo'=> '9',
            'nombre'=> 'PO',
        ]);
    }
}
