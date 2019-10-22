<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthExtension extends Model
{
    protected $fillable = [
        'tipo', 'meses',
    ];
}
