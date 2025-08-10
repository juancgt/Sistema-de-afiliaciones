<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table="institucion";
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'direccion',
        'telefono',
        'estado',
        'id_usuario',

    ];
}
