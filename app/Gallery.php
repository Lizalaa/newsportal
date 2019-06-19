<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['cover_id', 'image'];

    public function gallery_image()
    {
        return $this->belongsTo('App\CoverImage');
    }
}
