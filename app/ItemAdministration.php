<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAdministration extends Model
{
    protected $primaryKey ="id";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id','item_name'
    ];

    public function administrations()
    {
        return $this->hasMany('App\Administration');
    }
}
