<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado_Aporte extends Model
{
    protected $table="afiliado_aporte";
    protected $fillable = [
        'id',
        'id_afiliado',
        'id_aporte',
        'id_usuario',
        'created_at',
        'updated_at',
    ];
}
