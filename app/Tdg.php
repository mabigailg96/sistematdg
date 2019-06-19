<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tdg extends Model
{
    //
    public function colleges(){
        return $this->belongsTo(Tdg::class);
    }
        
    public function agreements(){
        return $this->belongsToMany(Agreement::class);
    }
    protected $fillable = [
        'nombre', 'codigo','perfil','escuela_id',
    ];
}
