<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    protected $table="afiliado";
    protected $fillable = [
        'id',
        'item',
        'nombres',
        'apellidos',
        'ci',
        'sexo',
        'direccion',
        'estado_civil',
        'foto',
        'estado',
        'id_usuario',
        'id_institucion',
        'id_area',
    ];

    public function institucion(){
        return $this->belongsTo('Dist\Models\Institucion','id_institucion','id');
    }
    public function area(){
        return $this->belongsTo('Dist\Models\Area','id_area','id');
    }

    public function afiliado_aporte(){
        return $this->belongsToMany('Dist\Models\Aporte','afiliado_aporte','id_afiliado','id_aporte');
    }

}
