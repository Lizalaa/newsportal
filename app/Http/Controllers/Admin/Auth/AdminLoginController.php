<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
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
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout', 'edit', 'update');
    }

    public function showLoginForm() 
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        //validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Attempt to log the admin in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
            {
                echo "a";
                //check admin's email verification
                if(Auth::guard('admin')->user()->verified == 0) {
                    Auth::guard('admin')->logout();
                    return redirect()->back()->withErrors([
                    'message' => 'Your email is not verified.'
                    ])->withInput($request->only('email', 'remember'));
                }
                //redirect to dashboard
                return redirect()->intended(url('admin/home'));
            }

        return redirect()->back()->withErrors([
                    'message' => 'Invalid credentials, Please check your credentials and try again.'
                    ])->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }

}
