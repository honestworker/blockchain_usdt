<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $fillable = array( 'title','subtitle', 'color', 'cur','cursym','reg','emailver','smsver','decimal',
    'emailnotf','smsnotf','email','template','smsapi');
    
}
