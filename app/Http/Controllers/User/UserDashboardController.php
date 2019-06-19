<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\UserRepository;
use Auth;

class UserDashboardController extends Controller
{
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth:web')->except('create', 'store', 'verification', 'login');
        $this->users = $users;
    }
    
    public function index()
    {
        $title = "Dashboard";
        $this->user = $userdetail = User::find(Auth::user()->id);
        $settings = $this->users->get_settings();
        $sidebar_data = $this->users->get_category_for_sidebar();
        $news = $this->users->count_news(Auth::user()->id);
        return view('user.dashboard', compact('userdetail', 'title', 'settings', 'sidebar_data', 'news'));
    }
}
