<?php

use Illuminate\Database\Seeder;
use App\TypeExtension;


class TypeExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TypeExtension::create([
            'tipo'=> 'Prórroga',
            'meses'=> '6',
        ]);

        TypeExtension::create([
            'tipo'=> 'Extensión de prórroga',
            'meses'=> '3',
        ]);

        TypeExtension::create([
            'tipo'=> 'Prórroga especial',
            'meses'=> '3',
        ]);

        TypeExtension::create([
            'tipo'=> 'Finalización',
            'meses'=> '9',
        ]);
    }
}
