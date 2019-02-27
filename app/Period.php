<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
	protected $primaryKey ="id";
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','starts','ends'
    ];
}
