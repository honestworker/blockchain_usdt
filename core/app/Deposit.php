<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = array( 'user_id','gateway_id','amount',
    'charge','usd_amo','btc_amo','btc_wallet','trx','round_id','team_id','status');

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

    public function gateway()
    {
        return $this->belongsTo('App\Gateway');
    }
}
