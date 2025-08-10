<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table="area";
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'estado',
        'id_usuario',
    ];
    public function actividad(){
        return $this->belongsToMany('Dist\Models\Actividad','area_actividad','id_area','id_actividad');
    }
    public function aporte(){
        return $this->belongsToMany('Dist\Models\Aporte','area_aporte','id_area','id_aporte');
    }
}
