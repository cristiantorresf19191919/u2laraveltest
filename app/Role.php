<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'is_admin',
    ];




    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
