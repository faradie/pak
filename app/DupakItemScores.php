<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DupakItemScores extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id','item_id','submission_id','nip','item_score','times','type'
    ];
}
