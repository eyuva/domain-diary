<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Whois;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $user = auth()->user();
        $data['user'] = $user;
        $data['categories'] = $user->categories;
        $data['tags'] = $user->tags;
        $data['domains'] = $user->domains;
        return view('home',$data);
    }
}
