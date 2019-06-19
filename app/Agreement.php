<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    //
    public function tdgs()
    {
        return $this->belongsToMany(Tdg::class);
    }

    protected $fillable = [
        'nombre','url',
    ];
}
