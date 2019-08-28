<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'carnet'     => $row[0],
            'nombres'    => $row[1],
            'apellidos'  => $row[2],
            'escuela_id' => 8,
        ]);
    }
}
