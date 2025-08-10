<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table="actividad";
    protected $fillable = [
        'id',
        'actividad',
        'inicio',
        'fin',
        'descripcion',
        'id_usuario',
    ];
}
