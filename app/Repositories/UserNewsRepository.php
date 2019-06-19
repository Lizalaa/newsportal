<?php

namespace App\Repositories;

use App\User;
use App\UserNews;
use App\Category;

class UserNewsRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return UserNews::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function get_category()
    {   
        $this->categoryTbl = 'categories';
        
        return UserNews::select('category', 'id')
        ->from($this->categoryTbl)
        ->where('parentcategory', '0')
        ->get();
    }


    public function getSubCategory($id)
    {
        return UserNews::select('category', 'id')
                    ->from('categories')
                    ->where('parentcategory', $id)
                    ->get();
    }

    public function get_news_by_id($id)
    {
        $this->newsTbl = 'user_news';
        $this->categoryTbl = 'categories';
        return UserNews::select("$this->newsTbl.id","$this->newsTbl.title","$this->newsTbl.date","$this->newsTbl.subcategory","$this->newsTbl.image", "$this->newsTbl.description", "$this->newsTbl.video_link", "$this->newsTbl.permalink",  "$this->newsTbl.status", "$this->categoryTbl.category")
                    ->from($this->newsTbl)
                    ->join($this->categoryTbl, "$this->categoryTbl.id", "=", "$this->newsTbl.category")
                    ->where('user_id', $id)
                    ->get();
    }

    public function get_detail_news_by_permalink($permalink)
    {       
        $this->newsTbl = 'user_news';
        $this->categoryTbl = 'categories';
        return UserNews::select("$this->newsTbl.id","$this->newsTbl.title","$this->newsTbl.created_at","$this->newsTbl.subcategory","$this->newsTbl.image", "$this->newsTbl.description", "$this->newsTbl.video_link", "$this->newsTbl.permalink", "$this->categoryTbl.category")
                    ->from($this->newsTbl)
                    ->join($this->categoryTbl, "$this->categoryTbl.id", "=", "$this->newsTbl.category")
                    ->where("$this->newsTbl.permalink", $permalink)
                    ->get();
    }

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