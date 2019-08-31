<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class StudentsImport implements ToModel, WithHeadingRow
{
    /*
    Autor: Guillermo Cornejo
    */
    private $id;

    public function __construct($idEscuela)
    {
        // Obtenemos el id de la escuela que ha sido pasado desde
        //el controlaor StudentController
        $this->id = $idEscuela;
    }
    public function model(array $row)
    {
        return new Student([
            'carnet'     => $row['carnet'],
            'nombres'    => $row['nombres'],
            'apellidos'  => $row['apellidos'],
            'escuela_id' => $this->id,
        ]);
    }
}
