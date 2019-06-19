<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class UserLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout', 'edit', 'update');
    }

    public function login_check()
    {
        if(!empty(Auth::user()->id))
        {
            echo json_encode("a");
        }
    }

    public function login(Request $request)
    {
        $email = $request->login_email;
        $password = $request->login_password;
        //validate the form data
        $validation = Validator::make($request->all(), [
            'login_email' => 'required|email',
            'login_password' => 'required|min:8'
        ]);
        if ($validation->fails()) {
            $msg = $validation->errors();

            
             echo json_encode($msg);
            
        }
         else {

        //Attempt to log the user in
        if(Auth::guard('web')->attempt(['email' => $request->login_email, 'password' => $request->login_password]))
            {
                //check user's email verification
                if(Auth::guard('web')->user()->verified == 0) {
                   Auth::guard('web')->logout();
                    echo json_encode(2);
                }
                else {
                    //redirect to dashboard
                    echo json_encode(1);
                }
                
            }
            else {
                echo json_encode(0);
            }
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }

}
