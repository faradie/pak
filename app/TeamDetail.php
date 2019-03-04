<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamDetail extends Model
{
	public $incrementing = false;
	public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id','nip','submission_id','position','individual_score'
    ];
}
