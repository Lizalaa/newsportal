<?php

namespace App\Repositories;

use App\Admin;
use App\News;
use App\Category;

class NewsRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  Admin  $admin
     * @return Collection
     */
    public function forUser(Admin $admin)
    {
        return News::where('user_id', $admin->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function get_category()
    {   
        $this->categoryTbl = 'categories';
        
        return News::select('category', 'id')
        ->from($this->categoryTbl)
        ->where('parentcategory', '0')
        ->get();
    }

    public function display_news()
    {
         $this->newsTbl = 'news';
        $this->categoryTbl = 'categories';
        
        return News::select("$this->newsTbl.id","$this->newsTbl.title","$this->newsTbl.created_at","$this->newsTbl.subcategory","$this->newsTbl.image", "$this->newsTbl.description", "$this->newsTbl.publish", "$this->newsTbl.feature", "$this->categoryTbl.category")
                    ->from($this->newsTbl)
                    ->join($this->categoryTbl, "$this->categoryTbl.id", "=", "$this->newsTbl.category")
                    ->get();
    }

    public function getSubCategory($id)
    {
        return News::select('category', 'id')
        ->from('categories')
        ->where('parentcategory', $id)->get();
    }

    public function get_user_news()
    {
         $this->newsTbl = 'user_news';
        $this->categoryTbl = 'categories';
        
        return News::select("$this->newsTbl.id","$this->newsTbl.title","$this->newsTbl.created_at","$this->newsTbl.subcategory","$this->newsTbl.image", "$this->newsTbl.video_link","$this->newsTbl.description", "$this->newsTbl.status", "$this->categoryTbl.category")
                    ->from($this->newsTbl)
                    ->join($this->categoryTbl, "$this->categoryTbl.id", "=", "$this->newsTbl.category")
                    ->get();
    }

   
}