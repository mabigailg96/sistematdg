<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


use App\Tdg;
use App\Http\Controllers\RequestApprovedController;

class TdgTableSeeder extends Seeder
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

            //Rescatando el ultimo tdgs ingresado en la base de datos.
            $lastTdg = DB::table('tdgs')->where('escuela_id', '=', $escuela_id)->orderBy('id', 'DESC')->first();
            //psi19001
            if ($lastTdg == null) {
                $lastCorrelativo = 0;
            } else {
                //Partiendo el codigo del TDG para solo extraer el correlativo.
                $lastCorrelativo = (int) substr($lastTdg->codigo, strlen($lastTdg->codigo) - 3, strlen($lastTdg->codigo));
            }

            //Hacer codigo de TDG

            //Obteniendo la escuela.
            $escuela = DB::table('colleges')->find($escuela_id);
            $correlativo = '';

            //Verificando el ultimo id, para completar el correlativo.
            if ($lastCorrelativo < 9) {
                $correlativo = '00';
            }
            if ($lastCorrelativo >= 9 && $lastCorrelativo < 99) {
                $correlativo = '0';
            }

            // Seleccionar un estado oficial

            //$estado_oficial = ['Aprobado','Oficializado','Abandonado','Prórroga','Extensión de prórroga','Prórroga especial','Finalizado'];
            //$numero_estado = rand(0,6);


            //Nuevo codigo TDG
            $codigo = 'P' . $escuela->nombre . date("y") . $correlativo . ($lastCorrelativo + 1);


            $tdg = Tdg::create([
                'nombre' => $this->faker->sentence,
                'escuela_id' => $escuela_id,
                'codigo' => $codigo,
                //'estado_oficial' => $estado_oficial[$numero_estado],
                //'solicitud_escuela' => 'Recien ingresado',
                'perfil' => 'Perfil N-'.$i.'.pdf',
                'ciclo_id' => rand(1,3),
            ]);

            //Aqui guardamos la solicitud para apobacion ya que es el primer paso del proceso, donde se sube el perfil en espera de la respuesta
            $requestApproved = new RequestApprovedController();
            $approved = $requestApproved->store($tdg->id);
        }
    }
}
