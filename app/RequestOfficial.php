<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestOfficial extends Model
{
    //
    public function tdg(){
        return $this->belongsTo(Tdg::class);
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }
}
