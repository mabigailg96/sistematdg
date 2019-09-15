<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function college(){
        return $this->belongsTo(College::class);
    }

    public function tdgs(){
        return $this->belongsToMany(Tdg::class)->withPivot('ciclo_id','nota','activo');
    }

    protected $fillable = [
        'carnet', 'nombres','apellidos','escuela_id',
    ];
}
