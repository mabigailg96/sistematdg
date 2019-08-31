<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
        'codigo', 'nombre','apellido','escuela_id',
    ];
}
