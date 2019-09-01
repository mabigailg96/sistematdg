<?php

use Illuminate\Database\Seeder;
use App\Semester;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'ciclo'=> 'I-2018',
            'fechaInicio'=> '2018-02-12',
        ]);
        Semester::create([
            'ciclo'=> 'II-2018',
            'fechaInicio'=> '2018-08-12',
        ]);
        Semester::create([
            'ciclo'=> 'I-2019',
            'fechaInicio'=> '2019-02-12',
        ]);
        Semester::create([
            'ciclo'=> 'II-2019',
            'fechaInicio'=> '2019-08-12',
        ]);
    }
}
