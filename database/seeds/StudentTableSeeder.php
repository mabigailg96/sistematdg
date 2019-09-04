<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Student;

class StudentTableSeeder extends Seeder
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
            $student = Student::create([
                'carnet' => Str::random(2).rand(10,18).rand(100,999),
                'nombres' => Str::random(70),
                'apellidos' => Str::random(70),
                'escuela_id' => $escuela_id,
            ]);
        }
    }
}
