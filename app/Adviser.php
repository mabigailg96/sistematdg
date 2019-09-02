<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    //
    public function tdgs(){
        return $this->belongsToMany(Tdg::class);
    }
}
