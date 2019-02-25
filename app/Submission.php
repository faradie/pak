<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $primaryKey ="id";
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nip','submission_position','submission_status','series_number','submission_score','team_score','SKFileUrl','submissionType'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
