<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpScores extends Model
{
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id','submission_id','item_score'
    ];//
}
