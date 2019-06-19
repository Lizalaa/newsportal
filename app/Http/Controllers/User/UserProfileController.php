<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\UserRepository;
use Auth;
use Validator;
use File;

class UserProfileController extends Controller
{

    public function __construct(UserRepository $users)
    {
        $this->middleware('auth:web');
        $this->users = $users;
    }
    public function index()
    {
        $title = "Profile";
        $this->user = $userdetail = User::find(Auth::user()->id);
        $settings = $this->users->get_settings();
        $sidebar_data = $this->users->get_category_for_sidebar();
        return view('user.profile', compact('userdetail', 'title', 'settings', 'sidebar_data'));

    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        //validate the form
        $this->validate(request(), [

            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            //'password' => 'confirmed',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


        //validate if there is password
        if (request('password') != null) {
            echo "a";
            $pass = (['password' => request('password')]);
            $data = (['password' => bcrypt(request('password'))]);
            User::where('id', $id)->update($data);
        } else {
            $pass = ([]);
        }

         $v = Validator::make($pass, [
            'password' => 'min:8'
        ]);

        if ($v->fails()) {
            return redirect('user/profile')
                        ->withErrors($v)
                        ->withInput();
        }

        $user->email = $request->get('email');        
        $user->name = $request->get('username');
        $user->password = bcrypt($request->get('password'));
        //validate if there is password
        
         if($request->hasfile('user_image'))
        {
            $file = $request->file('user_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/newuser_uploads/', $name);
            $usersImage = public_path("/uploads/newuser_uploads/").$request->get('previousimage'); // get previous image from folder
            // $dir_arr = explode(trim(" \ "), $usersImage);
            // $dir_arr2 = implode(trim(" / "), $dir_arr);
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }
            $user->profile_picture = $name;

            $user->save();
            return redirect('user/profile')->with('success', 'Profile has been updated');
        }
        else 
        {
            $user->save();
            return redirect('user/profile')->with('success', 'Profile has been updated');
        }
    }
}
