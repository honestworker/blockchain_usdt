<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
    protected $fillable = ['about_heading','about_details','about_image','video','footer','contact_email','contact_number'];
}
