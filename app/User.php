<?php

namespace Dist;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'role','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('Dist\Models\Role');
    }

    public function persona(){
        return $this->belongsTo('Dist\Models\Persona','id_persona','id_persona');
    }
    /*public function course(){
        return $this->belongsToMany('Dist\User','users_courses');
    }

    public function solutions(){
        return $this->hasMany('Dist\Models\Solution');
    }*/
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Notifications\CambiarPassword($token));
    }
}
