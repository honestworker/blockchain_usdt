<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $table = 'gateways';
	protected $fillable = array('name', 'minamo', 'maxamo', 'fixed_charge',
	'percent_charge', 'rate', 'val1', 'status');
    
    public function withdraw()
    {
        return $this->hasMany('App\Withdraw', 'id', 'wmethod_id');
    }
}
