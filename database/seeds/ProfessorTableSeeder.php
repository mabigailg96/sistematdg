<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Professor;

class ProfessorTableSeeder extends Seeder
{
    protected $faker;

public function __construct(Faker\Generator $faker) {
$this->faker = $faker;
}
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
                'codigo' => Str::random(2).rand(10,18).rand(100,999),
                    'nombre' => $this->faker->firstName.' '.$this->faker->firstName,
                    'apellido' => $this->faker->lastname.' '.$this->faker->lastname,
                    'escuela_id' => $escuela_id,
                ]);
            }
        }
    }
