<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $fillable = [
        'ciclo','fechaInicio',
    ];
}
