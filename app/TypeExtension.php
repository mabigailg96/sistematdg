<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeExtension extends Model
{
    //
    protected $fillable = [
        'tipo', 'meses',
    ];
}
