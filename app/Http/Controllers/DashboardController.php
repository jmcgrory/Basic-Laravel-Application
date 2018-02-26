<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get user ID with auth
        $user_id = auth()->user()->id;

        // Get actual user with Model query
        $user = User::find($user_id);

        // Return view and use User<-->Posts relationship to pull in posts
        return view('dashboard')->with('posts', $user->posts);
    }
}
