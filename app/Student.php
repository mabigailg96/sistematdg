<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function college(){
        return $this->belongsTo(College::class);
    }
    protected $fillable = [
        'carnet', 'nombres','apellidos','escuela_id',
    ];
}
