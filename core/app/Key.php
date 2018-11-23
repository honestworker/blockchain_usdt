<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $fillable = array('user_id','round_id','team_id','price','type','code','status');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function round()
    {
        return $this->belongsTo('App\Round');
    }
    
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}

