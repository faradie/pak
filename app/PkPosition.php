<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkPosition extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
