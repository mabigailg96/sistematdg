<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestTribunal extends Model
{
    //
    public function tdg(){
        return $this->belongsTo(Tdg::class);
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }

    public function professors(){
        return $this->belongsToMany(Professor::class);
    }

    
}
