<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Auth;
use App\Gallery;
use App\Repositories\GalleryRepository;
use App\CoverImage;
use App\Admin;
use File;
use App\Http\Controllers\Controller;


class GalleryController extends Controller
{
    protected $gallery;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GalleryRepository $gallery)
    {
        $this->middleware('auth:admin');

        $this->gallery = $gallery;
    }

    public function index()
    {
        $title = 'Albums';
        $gallery = \App\CoverImage::all();
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.lists.gallery', compact('gallery', 'title', 'user_detail'));
    }

    public function create()
    {
        $title = 'Add Albums';
        $this->user = $user_detail = Admin::find(Auth::user()->id);        
        return view('admin.form.gallery', compact('title', 'user_detail'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'name' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galleryimage' => 'required',
            'galleryimage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($request->hasfile('cover_image'))
        {
            $file = $request->file('cover_image');
            $covername = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/gallery_uploads/', $covername);
        }

        $cover = new CoverImage();
        $cover->name = $request->get('name');
        $cover->cover_image = $covername;
        
        $cover->save();
        
        $id = $cover->id;

        if(!empty($id))
        {
            if($request->hasfile('galleryimage'))
            {
                foreach($request->file('galleryimage') as $image)
                {
                    $name=rand(0,500).$image->getClientOriginalName();
                    $image->move(public_path().'/uploads/gallery_uploads/'.$id.'/', $name);  
                    //$data[] = $name;  
                    $gallery = new Gallery();
                    $gallery->cover_id = $id;
                    $gallery->image = $name;

                    $gallery->save();
                }
                    
        }
        return redirect('admin/gallery')->with('success', 'Images has been added');
        }
        

    }

    public function edit($id)
    {
        $title = 'Update Albums';                
        $gallery = \App\CoverImage::find($id);
        $images = $this->gallery->get_gallery($id);
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.form.gallery', compact('gallery', 'images', 'title', 'user_detail'));
    }

    public function update(Request $request, $id)
    {
        $cover = \App\CoverImage::find($id);        
        
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galleryimage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $cover->name = $request->get('name');
        if($request->hasfile('cover_image'))
        {
            $file = $request->file('cover_image');
            $covername = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/gallery_uploads/', $covername);
            $usersImage = public_path("/uploads/gallery_uploads/").$request->get('previousimage'); // get previous image from folder
            // $dir_arr = explode(trim(" \ "), $usersImage);
            // $dir_arr2 = implode(trim(" / "), $dir_arr);
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }
            $cover->cover_image = $covername;
            $cover->save();
        }
        
        if(!empty($id))
        {
            if($request->hasfile('galleryimage'))
            {
                foreach($request->file('galleryimage') as $image)
                {
                    $name=rand(0,500).$image->getClientOriginalName();
                    $image->move(public_path().'/uploads/gallery_uploads/'.$id.'/', $name);  
                    //$data[] = $name;  
                    $gallery = new Gallery();
                    $gallery->cover_id = $id;
                    $gallery->image = $name;

                    $gallery->save();
                }
        }
        else 
        {
            $cover->save();
        }
        return redirect('admin/gallery')->with('success', 'Images has been updated');
        }
        
    }

    public function destroy($id)
    {
        $gallery = \App\Gallery::find($id);
        $gallery->delete();
        $usersImage = public_path("/uploads/gallery_uploads/").$gallery->cover_id.'/'.$gallery->image; // get previous image from folder
        $dir_arr = explode(trim(" \ "), $usersImage);
        $dir_arr2 = implode(trim(" / "), $dir_arr);
        if (File::exists($dir_arr2)) 
        {
            @unlink($dir_arr2);
        }
        return redirect('gallery/edit/'.$gallery->cover_id);
    }

    public function destroy_folder($id)
    {
        $cover = \App\CoverImage::find($id);
        $cover->delete();
        $usersImage = public_path("/uploads/gallery_uploads/").$cover->cover_image; // get previous image from folder
        $dir_arr = explode(trim(" \ "), $usersImage);
        $dir_arr2 = implode(trim(" / "), $dir_arr);
        if (File::exists($dir_arr2)) 
        {
            @unlink($dir_arr2);
            File::deleteDirectory(public_path("/uploads/gallery_uploads/").$cover->id);
        }

        return redirect('admin/gallery');
    }
}
