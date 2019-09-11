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
        ]);

        TypeExtension::create([
            'tipo'=> 'Extensión',
        ]);

        TypeExtension::create([
            'tipo'=> 'Especial',
        ]);
    }
}
