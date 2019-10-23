<?php

use Illuminate\Database\Seeder;
use App\MonthExtension;

class MonthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonthExtension::create([
            'tipo'=> 'Prórroga',
            'meses'=> '6',
        ]);

        MonthExtension::create([
            'tipo'=> 'Extensión de prórroga',
            'meses'=> '3',
        ]);

        MonthExtension::create([
            'tipo'=> 'Finalización',
            'meses'=> '9',
        ]);
    }
}
