<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Professor;

class ProfessorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) { 
            $escuela_id = rand(1,9);
            $professor = Professor::create([
                'codigo' => Str::random(4).rand(10,18).rand(100,999),
                'nombre' => Str::random(70),
                'apellido' => Str::random(70),
                'escuela_id' => $escuela_id,
            ]);
        }
    }
}
