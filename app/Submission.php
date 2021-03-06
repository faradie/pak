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
        'id','nip','submission_position','submission_status','series_number','submission_score','previous_id','SKFileUrl','submissionType','starts','ends'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
