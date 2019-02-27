<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'submission_id','nip','disposition_content'
    ];
}
