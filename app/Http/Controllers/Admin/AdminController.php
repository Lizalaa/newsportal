<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Auth;
use App\Admin;
use App\Mail\AdminVerifyEmail;
use Validator;
use App\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $title = 'Users';
        //$users = User::paginate(10);
        $this->user = $user_detail = Admin::find(Auth::user()->id);

        $user = Admin::all();
        return view('admin.lists.admin', compact('users', 'title', 'user_detail'));
    }

    public function create()
    {
        $title = 'Add User';
        $this->user = $user_detail = Admin::find(Auth::user()->id);

        return view('admin.auth.register', compact('title', 'user_detail'));
    }

    public function store(Request $request)
    {
        
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:8',
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        if($request->hasfile('user_image'))
        {
            $file = $request->file('user_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/user_uploads/', $name);
        }

        $admin = new Admin();
        $admin->email = $request->get('email');        
        $admin->name = $request->get('name');
        $admin->password = bcrypt($request->get('password'));
        $admin->profile_picture = $name;
        $admin->userType = $request->get('userType');

        $admin->save();

        \Mail::to($admin)->send(new AdminVerifyEmail($admin));

        return redirect('admin')->with('success', 'User Added Successfully. Please check your email to verify your account.');
    }

    /**
     * User Email verification.
     */
    public function verification($token)
    {
        //fetch user by token
        $admin = Admin::whereToken($token)->firstOrFail()->confirmEmail();

        if(!is_null($admin)) { 
            return redirect()->intended(route('admin/login'))->with('success','Your email is verified.', 'title');
        }
        
        return redirect('admin/login')->with('error','Email could not be verified, Please try again.');
    }

    public function edit($id)
    {
        // edit user
        $user = Admin::find($id);
        $title = "Edit Profile";
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        return view('admin.auth.register', compact('user', 'title', 'user_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        
        //validate the form
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        //validate if there is password
        if (request('password') != null) {
            $pass = (['password' => request('password')]);
            $data = (['password' => bcrypt(request('password'))]);
            Admin::where('id', $id)->update($data);
        } else {
            $pass = ([]);
        }

        $v = Validator::make($pass, [
            'password' => 'min:8'
        ]);

        if ($v->fails()) {
            return redirect('admin/edit/'.$id)
                        ->withErrors($v)
                        ->withInput();
        }

        $admin->email = $request->get('email');        
        $admin->name = $request->get('name');
        $admin->password = bcrypt($request->get('password'));
        $admin->userType = $request->get('userType');
        //validate if there is password
        
         if($request->hasfile('user_image'))
        {
            $file = $request->file('user_image');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/user_uploads/', $name);
            $usersImage = public_path("/uploads/user_uploads/").$request->get('previousimage'); // get previous image from folder
            // $dir_arr = explode(trim(" \ "), $usersImage);
            // $dir_arr2 = implode(trim(" / "), $dir_arr);
            if (File::exists($usersImage)) 
            {
                @unlink($usersImage);
            }
            $admin->profile_picture = $name;

            $admin->save();
            return redirect('admin/profile')->with('success', 'Profile has been updated');
        }
        else 
        {
            $admin->save();
            return redirect('admin/profile')->with('success', 'Profile has been updated');
        }
    }

    public function profile()
    {
        $title = 'Profile';
        $this->user = $user_detail = Admin::find(Auth::user()->id);

        $users = Admin::find($this->user->id);
        return view('admin.lists.profile', compact('users', 'title', 'user_detail'));
    }

    public function assign(Admin $admin)
    {
        $roles = Role::get();

        $assigned = $admin->roles;

        return view('assign-roles', compact('admin', 'roles', 'assigned'));
    }

    public function assignRoles(Request $request, $id)
    {

        //validate the form
        $this->validate(request(), [

            'roles' => 'required'

            ]);

        $admin = Admin::findOrFail($id);

        //delete all existing roles of this admin
        DB::table('admin_role')->where('admin_id', '=', $id)->delete();

        $roles = request('roles');

        //dd($admin->roles);

        //assign roles to this admin
        foreach ($roles as $role) {
            $r = Role::whereName($role)->first();
            $admin->roles()->save($r);
        }

        return redirect('admin/assign/'.$id)->with('success','Role assigned.');

    }
}
