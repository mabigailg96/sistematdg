<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    //
    public function tdgs(){
        return $this->hasMany(Tdg::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
