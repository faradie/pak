<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey ="id";
    public $incrementing = false;
    
    public function file()
    {
        return $this->hasOne(File::class);
    }
}
