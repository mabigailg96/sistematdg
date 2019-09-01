<?php

namespace App\Imports;

use App\Professor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProfessorsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //Se obtiene el id de la escuela por medio de las
        //variables de session del usuario loggeado.
        $escuela = auth()->user()->college_id;
        return new Professor([
            'codigo'    => $row['codigo'],
            'nombre'    => $row['nombre'],
            'apellido'  => $row['apellido'],
            'escuela_id'=> $escuela,
        ]);
    }
}
