<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Ad;
use File;
use App\Http\Controllers\Controller;
use DB;


class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $ad = \App\Ad::all();
        $title = 'Ads';
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.lists.ads', compact('ad', 'title', 'user_detail'));
    }

    public function create()
    {
        $title = 'Add Ads';  
        $this->user = $user_detail = Admin::find(Auth::user()->id);      
        return view('admin.form.ads', compact('title', 'user_detail'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'ad_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        if($request->hasfile('ad_image'))
        {
            $file = $request->file('ad_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/ad_uploads/', $name);
        }

        $ad = new Ad();
        $ad->title = $request->get('title');
        $ad->image = $name;
        $ad->status = $request->get('status');
        $ad->save();

        return redirect('admin/ad')->with('success', 'Ad has been added');
    }

    public function edit($id)
    {
        $ad = \App\Ad::find($id);
        $title = 'Update Ads';
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.form.ads', compact('ad', 'title', 'user_detail'));
    }

    public function update(Request $request, $id)
    {
        $ad = \App\Ad::find($id);
        $this->validate($request, [
            'title' => 'required',
            'ad_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        $ad->title = $request->get('title');
        $ad->status = $request->get('status');

        if($request->hasfile('ad_image'))
        {
            $file = $request->file('ad_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/ad_uploads/', $name);
            $usersImage = public_path("/uploads/ad_uploads/").$request->get('previousimage'); // get previous image from folder
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }

            $ad->image = $name;
            $ad->save();

            return redirect('admin/ad')->with('success', 'Ad has been updated');
        }
        else 
        {
            $ad->save();
            return redirect('admin/ad')->with('success', 'Ad has been updated');
        }
    }


    public function destroy($id)
    {   
        $ad = \App\Ad::find($id);
        $ad->delete();
        $usersImage = public_path("/uploads/ad_uploads/").$ad->image; // get previous image from folder
        $dir_arr = explode(trim(" \ "), $usersImage);
        $dir_arr2 = implode(trim(" / "), $dir_arr);
        if (File::exists($dir_arr2)) 
        {
            @unlink($dir_arr2);
        }
        return redirect('admin/ad')->with('success','Information has been  deleted');
    }

    public function publish_ad($ad_id)
    {
        $update = DB::update('update ads set status = ? where id = ?',['1',$ad_id]);
        if($update)
        {
            return redirect('admin/ad')->with('success','Ad has been published');
        }
        
        
    }

    public function unpublish_ad($ad_id)
    {
        $update = DB::update('update ads set status = ? where id = ?',['0',$ad_id]);
        if($update)
        {
            return redirect('admin/ads')->with('success','Ad has been unpublished');
        }   
    }
}
