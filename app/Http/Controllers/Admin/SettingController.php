<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Settings;
use File;
use App\Admin;
use Auth;
use App\Http\Controllers\Controller;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $title = 'Update Settings';        

        $setting_data = \App\Settings::find(1);
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.form.settings', compact('setting_data', 'title', 'user_detail'));

    }

    public function update(Request $request, $id)
    {
        $setting = Settings::find($id);
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_link' =>'required',
            'twitter_link' =>'required'
        ]);
            
        $setting->name = $request->get('name');
        $setting->facebook_link = $request->get('facebook_link');
        $setting->twitter_link = $request->get('twitter_link');
        
        if($request->hasfile('logo'))
        {
            $file = $request->file('logo');

            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/setting_uploads/', $name);
            $usersImage = public_path("/uploads/setting_uploads/").$request->get('previouslogo'); // get previous image from folder
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }

            $setting->logo = $name;
            $setting->save();

            return redirect('admin/settings')->with('success', 'Settings has been updated');
        }
        else 
        {
            $setting->save();
            return redirect('admin/settings')->with('success', 'Settings has been updated');
        }

    }
}
