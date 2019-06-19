<?php

namespace App\Repositories;

use App\Admin;
use App\Site;
use DB;



class SiteRepository
{  
    /**
     * Get all of the tasks for a given user.
     *
     * @param  Admin  $admin
     * @return Collection
     */
    public function forUser(Admin $admin)
    {
        return Site::where('user_id', $admin->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function get_featured_news()
    {

        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        return Site::select("$this->categoryTbl.id","$this->categoryTbl.color","$this->categoryTbl.permalink as category_permalink","$this->categoryTbl.category","$this->newsTbl.title","$this->newsTbl.image","$this->newsTbl.created_at","$this->newsTbl.description","$this->newsTbl.subcategory","$this->newsTbl.permalink")
                    ->from("$this->categoryTbl")
                    ->join("$this->newsTbl", "$this->newsTbl.category",'=',"$this->categoryTbl.id")
                    ->where("$this->newsTbl.publish", '1')
                    ->where("$this->newsTbl.feature", '1')        
                    ->where("$this->categoryTbl.status", '1')
                    ->orderBy("$this->newsTbl.created_at", 'DESC')
                    ->limit(6)
                    ->get();
    }

    public function get_category_for_sidebar()
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        return Site::select("$this->categoryTbl.category","$this->categoryTbl.permalink")
                    ->from("$this->categoryTbl")
                    ->where('parentcategory', '0')
                    ->where('status', '1')       
                    ->get();
    }

    public function get_latest_news($page)
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        $offset = 3*$page; 
        $limit = 3;
        return Site::select("news.permalink", "news.id", "categories.category", "categories.permalink as category_permalink", "categories.color", "news.title","news.image", "news.created_at", "news.description")
                    ->from("$this->categoryTbl")
                    ->join("$this->newsTbl", "$this->newsTbl.category",'=',"$this->categoryTbl.id")
                    ->where("$this->newsTbl.publish", '1')
                    ->where("$this->categoryTbl.status", '1')
                    ->orderBy("$this->newsTbl.created_at", 'DESC')
                    ->limit($limit)
                    ->offset($offset)
                    ->get();
        // $sql = "Select news.permalink, news.id, categories.category, categories.permalink as category_permalink, categories.color, news.title,news.image, news.created_at, news.description from categories INNER JOIN news ON news.category=categories.id and publish='1' and status = '1' ORDER BY(created_at) DESC limit $offset ,$limit";
        // return Site::query($sql)->get();
    }

    public function display_popular_news()
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        return Site::select("*")
                    ->from("$this->newsTbl")
                    ->where("$this->newsTbl.publish", '1')
                    ->orderBy("$this->newsTbl.count_view", 'DESC')
                    ->limit(9)
                    ->get();
    }
    
    public function get_gallery()
    {
        $this->coverTbl = 'cover_images';

        return Site::select('id', 'name', 'cover_image')
                    ->from($this->coverTbl)
                    ->get();      
    }

    public function get_detail_news($permalink)
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        return Site::select("$this->categoryTbl.category", "$this->categoryTbl.permalink as category_permalink", "$this->categoryTbl.color", "$this->newsTbl.title","$this->newsTbl.image", "$this->newsTbl.description","$this->newsTbl.created_at","$this->newsTbl.permalink")
                    ->from($this->categoryTbl)
                    ->join("$this->newsTbl", "$this->newsTbl.category",'=',"$this->categoryTbl.id")
                    ->where("$this->newsTbl.permalink", $permalink)
                    ->get();
    }

    public function get_detail_news_side_display($category, $permalink)
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        return Site::select("$this->categoryTbl.category", "$this->newsTbl.title","$this->newsTbl.image","$this->newsTbl.description","$this->newsTbl.created_at","$this->newsTbl.permalink")
                    ->from($this->categoryTbl)
                    ->join($this->newsTbl, "$this->newsTbl.category","=","$this->categoryTbl.id")
                    ->where("$this->newsTbl.permalink","!=", $permalink)
                    ->where("$this->categoryTbl.category", $category)
                    ->where("$this->newsTbl.publish", '1')                    
                    ->orderBy("$this->newsTbl.created_at", 'DESC')
                    ->limit(2)
                    ->get();
    }

    public function get_category_news($permalink)
    {
        $this->categoryTbl = 'categories';
        $this->newsTbl = 'news';

        return Site::select("$this->categoryTbl.category", "$this->newsTbl.title","$this->newsTbl.image","$this->newsTbl.description","$this->newsTbl.created_at","$this->newsTbl.permalink")
                    ->from($this->categoryTbl)
                    ->join($this->newsTbl, "$this->newsTbl.category","=","$this->categoryTbl.id")
                    ->where("$this->categoryTbl.permalink", $permalink)
                    ->where("$this->newsTbl.publish", '1')
                    ->orderBy("$this->newsTbl.created_at", 'DESC')
                    ->get();
        
    }

    public function get_full_gallery($cover_id)
    {
        $this->coverTbl = 'cover_images';
        $this->galleryTbl = 'galleries';

        return Site::select("*")
                    ->from($this->galleryTbl)
                    ->join($this->coverTbl, "$this->galleryTbl.cover_id","=","$this->coverTbl.id")
                    ->where("$this->galleryTbl.cover_id",$cover_id)
                    ->get();         
    }

    public function get_gallery_name($cover_id)
    {
        $this->coverTbl = 'cover_images';

        return Site::select("name")
                    ->from($this->coverTbl)
                    ->where("$this->coverTbl.id",$cover_id)
                    ->get();         
    }

    public function get_settings()
    {
        $this->settingTbl = 'settings';

        return Site::select("*")
                    ->from("$this->settingTbl")
                    ->first();
    }
}
