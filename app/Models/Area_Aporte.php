<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

class Area_Aporte extends Model
{
    protected $table="area_aporte";
    protected $fillable = [
        'id',
        'id_area',
        'id_aporte',
        'created_at',
        'updated_at',
    ];
}
