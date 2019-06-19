<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Admin;
use App\Category;
use App\News;
use File;
use Input;
use DB;

class NewsController extends Controller
{
    protected $news;

    public function __construct(NewsRepository $news)
    {
        $this->middleware('auth:admin');

        $this->news = $news;
    }

    public function index()
    {
        $title = 'News';        

        $news = $this->news->display_news();
        $this->user = $user_detail = Admin::find(Auth::user()->id);

        return view('admin.lists.news', compact('news', 'category', 'title', 'user_detail'));
    }
    

    public function create()
    {
        $title = 'Add News';        
        $category = $this->news->get_category();
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.form.news', compact('category', 'title', 'user_detail'));
    }

    public function store(Request $request)
    {
        $date = date('Y-m-d');
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required|max:1000',
            'category' => 'required|not_in:-1',
            'news_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|date|after:'.$date,
        ]);

        if($request->hasfile('news_image'))
        {
            $file = $request->file('news_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/news_uploads/', $name);
        }

        $news = new News();
        $news->title = $request->get('title');
        $news->date = $request->get('date');
        $news->image = $name;
        $news->description = $request->get('description');
        $news->category = $request->get('category');
        $news->subcategory = $request->get('subcategory');        
        $news->feature = $request->get('feature');
        $news->publish = $request->get('publish');
        $news->permalink = $this->generateRandomString();        
        
        $news->save();
        return redirect('admin/news')->with('success', 'News has been added');
    }

    public function edit($id)
    {
        $title = 'Update News';                
        $news = \App\News::find($id);
        $category = $this->news->get_category();    
        $this->user = $user_detail = Admin::find(Auth::user()->id);    
        return view('admin.form.news', compact('news', 'category', 'title', 'user_detail'));
    }

    public function update(Request $request, $id)
    {
        $news = \App\News::find($id);
        $date = date('Y-m-d');

        $this->validate($request,[
            'title'=>'required',
            'description'=>'required|max:1000',
            'category' => 'required|not_in:-1',
            'news_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|date|after:'.$date,
        ]);

        $news->title = $request->get('title');
        $news->date = $request->get('date');
        $news->description = $request->get('description');
        $news->category = $request->get('category');
        $news->subcategory = $request->get('subcategory');
        $news->feature = $request->get('feature');
        $news->publish = $request->get('publish');
        $news->permalink = $this->generateRandomString();
        if($request->hasfile('news_image'))
        {
            $file = $request->file('news_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/news_uploads/', $name);
            $usersImage = public_path("/uploads/news_uploads/").$request->get('previousimage'); // get previous image from folder
            $dir_arr = explode(trim(" \ "), $usersImage);
            $dir_arr2 = implode(trim(" / "), $dir_arr);
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }
            $news->image = $name;

            $news->save();
            return redirect('admin/news')->with('success', 'News has been updated');
        }
        else 
        {
            $news->save();
            return redirect('admin/news')->with('success', 'News has been updated');
        }
    }

    public function destroy($id)
    {
        $news = \App\News::find($id);
        $news->delete();
        $usersImage = public_path("/uploads/news_uploads/").$news->image; // get previous image from folder
        $dir_arr = explode(trim(" \ "), $usersImage);
        $dir_arr2 = implode(trim(" / "), $dir_arr);
        if (File::exists($dir_arr2)) 
        {
            @unlink($dir_arr2);
        }
        return redirect('admin/news')->with('success','Information has been deleted');
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
        $data = $this->news->getSubCategory($category);
        foreach ($data as $value) 
        {
            $id = $value['id'];
            $sub_category = $value['category'];
            $sub_data[] = array("id" =>$id, "category" => $sub_category);
        }
        echo json_encode($sub_data);
    }

    public function publish_news($news_id)
    {
        $update = DB::update('update news set publish = ? where id = ?',['1',$news_id]);
        if($update)
        {
            return redirect('admin/news')->with('success','News has been published');
        }
        
        
    }

    public function unpublish_news($news_id)
    {
        $update = DB::update('update news set publish = ? where id = ?',['0',$news_id]);
        if($update)
        {
            return redirect('admin/news')->with('success','News has been unpublished');
        }   
    }

    public function get_user_news()
    {
        $title = 'User News';        
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        $news = $this->news->get_user_news();
        return view('admin.lists.usernews', compact('news', 'title', 'user_detail'));
    }

    public function publish_user_news($news_id)
    {
        $update = DB::update('update user_news set status = ? where id = ?',['1',$news_id]);
        if($update)
        {
            return redirect('admin/usernews')->with('success','News has been published');
        }
        
        
    }

    public function unpublish_user_news($news_id)
    {
        $update = DB::update('update user_news set status = ? where id = ?',['0',$news_id]);
        if($update)
        {
            return redirect('admin/usernews')->with('success','News has been unpublished');
        }   
    }
}

