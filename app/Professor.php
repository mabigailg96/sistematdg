<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{

    public function tdgs(){
        return $this->belongsToMany(Tdg::class);
    }

    public function tdg(){
        return $this->hasMany(Tdg::class);
    }

    public function request_tribunals(){
        return $this->belongsToMany(RequestTribunal::class);
    }

    public function college(){
        return $this->belongsTo(College::class);
    }


    protected $fillable = [
        'codigo', 'nombre','apellido','escuela_id','estado',
    ];
}
