<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasatiempo extends Model
{
    //
    protected $fillable = [
        'name', 'description','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
