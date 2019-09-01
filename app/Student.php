<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'carnet', 'nombres','apellidos','escuela_id',
    ];
}
