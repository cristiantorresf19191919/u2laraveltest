<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','city'
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

    public function pasatiempos()
    {
        return $this->hasMany('App\Pasatiempo');
    }

    public function tareas()
    {
        return $this->hasMany('App\Tarea');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function autorizeRoles($roles){
        if ($this->tineAlgunRole($roles)){
            return true;
        }

    }


}
