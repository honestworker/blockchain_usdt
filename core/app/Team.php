<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = array('name','image','amount','details','status');

    public function keys()
    {
        return $this->hasMany('App\Key', 'id', 'round_id');
    }
    public function deposit()
    {
        return $this->hasMany('App\Deposit', 'id', 'team_id');
    }
}
