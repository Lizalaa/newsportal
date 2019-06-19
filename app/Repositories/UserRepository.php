<?php
namespace App\Repositories;

use App\User;
use DB;

class UserRepository
{  
    public function get_settings()
    {
        $this->settingTbl = 'settings';

        return User::select("*")
                    ->from("$this->settingTbl")
                    ->first();
    }

    public function get_category_for_sidebar()
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'user_news';

        return User::select("$this->categoryTbl.category","$this->categoryTbl.permalink")
                    ->from("$this->categoryTbl")
                    ->where('parentcategory', '0')
                    ->where('status', '1')       
                    ->get();
    }

    public function count_news($id)
    {
        $this->newsTbl = 'user_news';

        return User::select('id')
                        ->from($this->newsTbl)
                        ->where('user_id', $id)
                        ->count('id');
    }
}