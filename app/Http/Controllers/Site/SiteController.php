<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Auth;
use App\Site;
use App\Repositories\SiteRepository;
use App\Admin;
use Input;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    protected $site;

    public function __construct(SiteRepository $site)
    {
        $this->site = $site;
    }

    public function index()
    {
        $news_featured = $this->site->get_featured_news();
        $sidebar_data = $this->site->get_category_for_sidebar();
        $news_popular = $this->site->display_popular_news();
        $gallery_data = $this->site->get_gallery();
        $settings = $this->site->get_settings();
        $title = 'Swadesh Sandesh';
        return view('site.index', compact('news_featured', 'sidebar_data', 'news_popular', 'gallery_data', 'title', 'settings'));
    }

    public function index_load()
    {
        $page = Input::get('page');

        $category= $this->site->get_latest_news($page);

        if($category == "[]")
        {
            echo json_encode(1);
        }
        else
        {
            foreach ($category as $value) 
            {
                $php_timestamp =strtotime($value->created_at); 
                $created_at = date("d F Y H:i:s", $php_timestamp);

                $id = $value->id;
                $title = $value->title;
                $category = $value->category;
                $permalink = $value->permalink;
                $image = $value->image;
                $description = $value->description;
                $color = $value->color;
                $category_permalink = $value->category_permalink;

                $sub_data[] = array("id" =>$id, "category" => $category, "permalink" => $permalink, "image" => $image, "created_at" => $created_at, "title" => $title, "description" => $description, "date" => $created_at, "color" => $color, "category_permalink" => $category_permalink);
            }
            echo json_encode($sub_data);
        }
    }

    function count_view()
    {
        $permalink = Input::get('link'); echo json_encode($permalink);
        $site = new Site();
        $site->count_view($permalink);
    }

    function detail($permalink)
    {
        $detail=array();
        $sidebar_data = $this->site->get_category_for_sidebar();
        $detail_cat = $this->site->get_detail_news($permalink);
        $settings = $this->site->get_settings();
        if(empty($detail_cat))
        {
            redirect('error');
        }
        else
        {
            foreach ($detail_cat as $value) 
            {
                $cat_for_other_display = $value['category'];
                $cat_title = $value['title'];
            }
            $title = $cat_title;
            $other_details = $this->site->get_detail_news_side_display($cat_for_other_display, $permalink);
            return view('site.detail', compact('sidebar_data', 'detail_cat', 'other_details', 'title', 'settings'));
        }
    }

    function category($permalink)
    {
        $sidebar_data = $this->site->get_category_for_sidebar();
        $categorylist = $this->site->get_category_news($permalink);
        $gallery_data = $this->site->get_gallery();
        $settings = $this->site->get_settings();

        if(empty($categorylist))
        {
            redirect('error');
        }
        else
        {
            foreach ($categorylist as $value) 
            {
            $category_title = $value['category'];
            }
            $title = $category_title;
            return view('site.category', compact('sidebar_data', 'categorylist', 'gallery_data', 'title', 'settings'));
        }
    }

    public function gallery()
    {
        $sidebar_data = $this->site->get_category_for_sidebar();        
        $gallery_data = $this->site->get_gallery();
        $settings = $this->site->get_settings();
        $title = 'Album';
        return view('site.gallery', compact('sidebar_data','gallery_data', 'title', 'settings'));        
    }

    public function gallery_name($cover_id)
    {
        $sidebar_data = $this->site->get_category_for_sidebar();        
        $all_image = $this->site->get_full_gallery($cover_id);
        $gallery_name = $this->site->get_gallery_name($cover_id);
        $settings = $this->site->get_settings();
        foreach($gallery_name as $value) 
        {
            $gallery_title = $value['name'];
        }
        $title = $gallery_title;
        return view('site.gallery_image', compact('sidebar_data','all_image', 'title', 'settings'));        
    }
}

