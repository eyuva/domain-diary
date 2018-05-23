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
        $data['user'] = auth()->user();
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('home',$data);
    }
}
