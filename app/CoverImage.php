<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    protected $fillable = ['name', 'cover_image'];

    public function image()
    {
        return $this->belongsToMany('App\Gallery');
    }

}