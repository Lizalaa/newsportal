<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['name','logo', 'facebook_link', 'twitter_link'];
}
