<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Repositories\CategoryRepository;
use App\Admin;
use App\Category;
use File;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $category)
    {
        $this->middleware('auth:admin');

        $this->category = $category;
    }


    public function index()
    {
        $category = \App\Category::all();
        $title = 'Categories';
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.lists.category', compact('category', 'title', 'user_detail'));

    }

    public function create()
    {
        $title = 'Add Categories';        
        $parentcategory = $this->category->get_parent();
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.form.category', compact('parentcategory', 'title', 'user_detail'));
    }

    public function store(Request $request)
    {
        $date = date('Y-m-d');
        $this->validate($request,[
            'category' => 'required',
            'date' => 'required|date|after:'.$date,
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'=>'required|max:1000',
            'color'=>'required',
            'permalink'=>'required',
            'order'=>'required|integer'            
        ]);

        if($request->hasfile('category_image'))
        {
            $file = $request->file('category_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/category_uploads/', $name);
        }

        $category = new Category();
        $category->parentcategory = $request->get('parentcategory');        
        $category->category = $request->get('category');
        $category->date = $request->get('date');
        $category->image = $name;
        $category->description = $request->get('description');
        $category->status = $request->get('status');
        $category->color = $request->get('color');
        $category->order = $request->get('order');
        $category->permalink = $this->sluggable($request->get('permalink'));

        
        $category->save();
        return redirect('admin/category')->with('success', 'Category has been added');
    }

    public function edit($id)
    {
        $title = 'Update Categories';        
        $category = \App\Category::find($id);
        $parentcategory = $this->category->get_parent();
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.form.category', compact('category', 'parentcategory', 'title', 'user_detail'));
    }

    public function update(Request $request, $id)
    {
        $category = \App\Category::find($id);
        $date = date('Y-m-d');
        $this->validate($request,[
            'category' => 'required',
            'date' => 'required|date|after:'.$date,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'=>'required|max:1000',
            'color'=>'required',
            'permalink'=>'required',
            'order'=>'required|integer'            
        ]);

        $category->parentcategory = $request->get('parentcategory');                
        $category->category = $request->get('category');
        $category->date = $request->get('date');
        $category->description = $request->get('description');
        $category->status = $request->get('status');
        $category->color = $request->get('color');
        $category->order = $request->get('order');
        $category->permalink = $this->sluggable($request->get('permalink'));

        if($request->hasfile('category_image'))
        {
            $file = $request->file('category_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/category_uploads/', $name);
            $usersImage = public_path("/uploads/category_uploads/").$request->get('previousimage'); // get previous image from folder
            // $dir_arr = explode(trim(" \ "), $usersImage);
            // $dir_arr2 = implode(trim(" / "), $dir_arr);
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }
            $category->image = $name;

            $category->save();
            return redirect('admin/category')->with('success', 'Category has been updated');
        }
        else 
        {
            $category->save();
            return redirect('admin/category')->with('success', 'Category has been updated');
        }
    }

    public function destroy($id)
    {
        $category = \App\Category::find($id);
        $category->delete();
        $usersImage = public_path("/uploads/category_uploads/").$category->image; // get previous image from folder
        $dir_arr = explode(trim(" \ "), $usersImage);
        $dir_arr2 = implode(trim(" / "), $dir_arr);
        if (File::exists($dir_arr2)) 
        {
            @unlink($dir_arr2);
        }
        return redirect('admin/category')->with('success','Information has been deleted');
    }

    //for permalink
    public function sluggable($prefix)
    {
       $string = preg_replace("`\[.*\]`U", "", strtolower(trim($prefix)));
       $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
       $string = htmlentities($string, ENT_COMPAT, 'utf-8');
       $string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string);
       $string = preg_replace(array("`[^a-z0-9]`i","`[-]+`"), "-", $string);
       return $string;
    }

    public function publish_category($category_id)
    {
        $update = DB::update('update categories set status = ? where id = ?',['1',$category_id]);
        if($update)
        {
            return redirect('admin/category')->with('success','Category has been published');
        }
        
        
    }

    public function unpublish_category($category_id)
    {
        $update = DB::update('update categories set status = ? where id = ?',['0',$category_id]);
        if($update)
        {
            return redirect('admin/category')->with('success','Category has been unpublished');
        }   
    }
}
