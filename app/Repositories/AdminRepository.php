<?php
namespace App\Repositories;

use App\Admin;
use DB;

class AdminRepository
{  

    public function count_category()
    {
        $this->categoriesTbl = 'categories';

        return Admin::select('id')
                        ->from($this->categoriesTbl)
                        ->count('id');
    }

    public function count_news()
    {
        $this->newsTbl = 'news';

        return Admin::select('id')
                        ->from($this->newsTbl)
                        ->count('id');
    }

    public function count_ads()
    {
        $this->adsTbl = 'ads';

        return Admin::select('id')
                        ->from($this->adsTbl)
                        ->count('id');
    }

    public function count_admin()
    {
        $this->adminTbl = 'admins';

        return Admin::select('id')
                        ->from($this->adminTbl)
                        ->count('id');
    }
}