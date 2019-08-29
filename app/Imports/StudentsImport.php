<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /*  Aqui obtenemos el id de la escuela por medio del
        usario loggeado para asignarselo al estudiante
        Automaticamente */
        $escuela = auth()->user()->college_id;
       /* Se procede al llenado de la base de datos con los datos
       obtenidos por medio del excel
       Autor: Guillermo Cornejo  */
        return new Student([
            'carnet'     => $row['carnet'],
            'nombres'    => $row['nombres'],
            'apellidos'  => $row['apellidos'],
            'escuela_id' => $escuela,
        ]);
    }
}
