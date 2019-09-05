<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestName extends Model
{
    //
    public function tdg(){
        return $this->belongsTo(Tdg::class);
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }

    protected $fillable = ['nuevo_nombre', 'justifacion','tdg_id','fecha'];
}
