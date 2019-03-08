<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
	public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','submission_id','fileUrl','file_size','data_status','name','nameID'
    ];

    public function item_administrations()
    {
        return $this->belongsTo('App\ItemAdministration');
    }
}
