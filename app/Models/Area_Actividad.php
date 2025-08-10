<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Area_Actividad extends Model
{
    protected $table="area_actividad";
    protected $fillable = [
        'id',
        'id_area',
        'id_actividad',
        'created_at',
        'updated_at',
    ];
}
