<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tdg extends Model
{
    //
    public function college(){
        return $this->belongsTo(Tdg::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function professor(){
        return $this->belongsTo(Professor::class);
    }

    public function advisers(){
        return $this->belongsToMany(Adviser::class);
    }

    public function professors(){
        return $this->belongsToMany(Professors::class);
    }

    public function request_tribunals(){
        return $this->hasMany(RequestTribunal::class);
    }

    public function request_results(){
        return $this->hasMany(RequestResult::class);
    }

    public function request_approveds(){
        return $this->hasMany(RequestApproved::class);
    }
    
    public function request_officials(){
        return $this->hasMany(RequestOfficial::class);
    }
   
    public function request_names(){
        return $this->hasMany(RequestName::class);
    }

    public function request_extensions(){
        return $this->hasMany(RequestExtension::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class)->withPivot('ciclo_id','nota','activo');
    }



    protected $fillable = [
        'nombre', 'codigo','perfil','escuela_id','ciclo_id',
    ];
}
