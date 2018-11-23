<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = array('name','base_price','inc_rate','pot','winner','endin','status');

    public function deposit()
    {
        return $this->hasMany('App\Deposit', 'id', 'round_id');
    }
    public function keys()
    {
        return $this->hasMany('App\Key', 'id', 'round_id');
    }
}
