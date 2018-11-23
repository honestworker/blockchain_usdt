<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = array('user_id','coin_id', 'trxid', 'amount', 'balance','type','details');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
