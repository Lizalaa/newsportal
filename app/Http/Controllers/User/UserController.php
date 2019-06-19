<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use App\Mail\UserVerifyEmail;
use Validator;

class UserController extends Controller
{

    public function __construct(UserRepository $user)
    {
        //$this->middleware('auth:web');
        $this->user = $user;
    }


    public function index()
    {
        $title = 'Sign Up';
        $settings = $this->user->get_settings();
        $sidebar_data = $this->user->get_category_for_sidebar();
        return view('user.auth.register', compact('title', 'settings', 'sidebar_data'));
    }

    public function store(Request $request)
    {
        // dd($request->all()) ;
        $validation = Validator::make($request->all(), [
            'user_username' => 'required',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|min:8',
            ]);
        
        if ($validation->fails()) {
            // $errors = $v->errors();
            $msg = $validation->errors();

            
             echo json_encode($msg);
            
        }
         else {

    
        $user = new User();
        $user->email = $request->user_email;        
        $user->name = $request->user_username;
        $user->password = bcrypt($request->user_password);

        if($user->save())
        {
            echo json_encode(1);
        }
        \Mail::to($user)->send(new UserVerifyEmail($user));
    }
}

    /**
     * User Email verification.
     */
    public function verification($token)
    {
        //fetch user by token
        $user = User::whereToken($token)->firstOrFail()->confirmEmail();

        if(!is_null($user)) { 
            return redirect()->intended(route('/'))->with('success','Your email is verified.', 'title');
        }
        
        return redirect('/')->with('error','Email could not be verified, Please try again.');
    }

}
