<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
   
    public function request_approved(){
        return $this->hasOne(RequestApproved::class);
    }

    public function request_extension(){
        return $this->hasOne(RequestExtension::class);
    }

    public function request_name(){
        return $this->hasOne(RequestName::class);
    }

    public function request_official(){
        return $this->hasOne(RequestOfficial::class);
    }

    public function request_result(){
        return $this->hasOne(RequestResult::class);
    }

    public function request_tribunal(){
        return $this->hasOne(RequestTribunal::class);
    }

    protected $fillable = [
        'nombre','url','fecha','aprobado',
    ];
}
