<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Repositories\UserNewsRepository;
use App\UserNews;
use App\File;
use App\Category;
use Input;

class PostNewsController extends Controller
{
    public function __construct(UserNewsRepository $usernews)
    {
        $this->middleware('auth:web');
        $this->usernews = $usernews;
    }

    public function index()
    {
        $title = 'News';
        $usernews = $this->usernews->get_news_by_id(Auth::user()->id);
        $this->user = $userdetail = User::find(Auth::user()->id);        
        $sidebar_data = $this->usernews->get_category_for_sidebar();
        $settings = $this->usernews->get_settings();

        return view('user.displaynews', compact('usernews', 'title', 'userdetail', 'settings', 'sidebar_data'));
    }

    public function create()
    {
        $title = 'Post News';        
        $category = $this->usernews->get_category();
        $this->user = $userdetail = User::find(Auth::user()->id);
        $sidebar_data = $this->usernews->get_category_for_sidebar();
        $settings = $this->usernews->get_settings();
        return view('user.news', compact('category','title', 'userdetail', 'settings', 'sidebar_data'));
        
    }

    public function store(Request $request)
    {
        $date = date('Y-m-d');
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required|max:1000',
            'category' => 'required|not_in:-1',
            'video_link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|date|after:'.$date,
        ]);
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/usernews_uploads/', $name);
        }

        $usernews = new UserNews();
        $usernews->title = $request->get('title');
        $usernews->date = $request->get('date');
        $usernews->image = $name;
        $usernews->description = $request->get('description');
        $usernews->category = $request->get('category');
        $usernews->subcategory = $request->get('subcategory');   
        $usernews->video_link = $request->get('video_link');        
        $usernews->status = 0;
        $usernews->user_id = Auth::user()->id;
        $usernews->permalink = $this->generateRandomString();        
        
        $usernews->save();
        return redirect('user/news/create')->with('success', 'News has been added');
    }

    public function detail_news($permalink)
    {
        $title = 'Detail News';
        $detailnews = $this->usernews->get_detail_news_by_permalink($permalink);
        $this->user = $userdetail = User::find(Auth::user()->id);      
        $sidebar_data = $this->usernews->get_category_for_sidebar();
        $settings = $this->usernews->get_settings();  
        return view('user.detailnews', compact('detailnews', 'title', 'userdetail', 'settings', 'sidebar_data'));
    
    }
    /*
     * For permalink
     */

    function generateRandomString($length = 10) 
    { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $charactersLength = strlen($characters); 
        $randomString = ''; 
        for ($i = 0; $i < $length; $i++) 
        { 
            $randomString .= $characters[rand(0, $charactersLength - 1)]; 
        } 
        $string = $this->sluggable($randomString);
        return $string; 
    } 

    public function sluggable($prefix)
    {
       $string = preg_replace("`\[.*\]`U", "", strtolower(trim($prefix)));
       $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
       $string = htmlentities($string, ENT_COMPAT, 'utf-8');
       $string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string);
       $string = preg_replace(array("`[^a-z0-9]`i","`[-]+`"), "-", $string);
       return $string;
    }


    public function get_sub_category()
    {
        $data = array();
        $sub_data = array();
        $category = Input::get('category');
        $data = $this->usernews->getSubCategory($category);
        foreach ($data as $value) 
        {
            $id = $value['id'];
            $sub_category = $value['category'];
            $sub_data[] = array("id" =>$id, "category" => $sub_category);
        }
        echo json_encode($sub_data);
    }

}
