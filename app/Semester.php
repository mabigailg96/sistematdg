<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    public function tdgs(){
        return $this->hasMany(Tdg::class);
    }
    
    protected $fillable = [
        'ciclo','fechaInicio',
    ];
}
