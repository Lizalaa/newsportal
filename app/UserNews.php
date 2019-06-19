<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNews extends Model
{
    protected $fillable = ['title', 'video_link', 'date', 'image', 'permalink', 'description', 'category', 'user_id'];
}
