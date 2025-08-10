<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table="saldo";
    protected $fillable = [
        'id',
        'id_aporte',
        'id_afiliado',
        'saldo',
        'estado',
        'id_usuario',
    ];
    public function aporte(){
        return $this->belongsTo('Dist\Models\Aporte','id_aporte','id');
    }
}
