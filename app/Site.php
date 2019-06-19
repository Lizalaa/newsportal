<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Site extends Model
{
    
    public function count_view($permalink)
    {
        $this->newsTbl = 'news';
        DB::table("$this->newsTbl")
            ->where('permalink', $permalink)
            ->increment('count_view',1);
    }
}
