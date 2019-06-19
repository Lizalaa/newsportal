<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parentcategory', 'category', 'date', 'category_image', 'color','description','status', 'order', 'permalink'
    ];

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
}
