<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct(AdminRepository $admin)
    {
        $this->middleware('auth:admin');
        $this->admin = $admin;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user = $user_detail = Admin::find(Auth::user()->id);
        $title = "Dashboard";
        $news = $this->admin->count_news();
        $ads = $this->admin->count_ads();
        $category = $this->admin->count_category();
        $user = $this->admin->count_admin();
        return view('admin.home', compact('title','user_detail','user','news','category','ads'));
    }
}
