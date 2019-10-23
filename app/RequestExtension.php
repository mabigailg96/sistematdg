<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestExtension extends Model
{
    //
    public function tdg(){
        return $this->belongsTo(Tdg::class);
    }

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }

    
    protected $fillable = [
        'fecha', 'aprobado','fecha_inicio','fecha_fin','justificacion','url_documento_solicitud','tdg_id','agreement_id','type_extension_id',
    ];
}
