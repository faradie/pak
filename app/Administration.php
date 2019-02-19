<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'submission_id','fileUrl','file_size','data_status'
    ];
}
