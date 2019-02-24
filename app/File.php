<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','submission_id','fileUrl','file_size','data_status','times','type'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
