<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Aporte extends Model
{
    protected $table="aporte";
    protected $fillable = [
        'id',
        'motivo',
        'descripcion',
        'monto',
        'plazo',
        'estado',
        'id_usuario',
    ];
}
