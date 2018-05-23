<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $data['categories'] = Category::where('user_id','=',$user->id)->get();
        return view('category.index',$data);
    }
    public function edit($id)
    {
        $user = auth()->user();
        $data['category'] = Category::where('user_id','=',$user->id)->findOrFail($id);
        return view('category.edit',$data);
    }
    public function save()
    {
        $user = auth()->user();
        if(isset(request()->category_id)){
            $category = Category::where('user_id','=',$user->id)->findOrFail(request()->category_id);
            $message = 'Category Updated!';
        }else{
            $category = new Category();
            $message = 'Category Added!';
        }
        $category->user_id = $user->id;
        $category->name = request()->name;
        $category->save();

        $toast['type'] = 'info';
        $toast['message'] = $message;
        return back()->with(['toast' => $toast]);
    }
    public function delete($id)
    {
        $user = auth()->user();
        $category = Category::where('user_id','=',$user->id)->findOrFail($id);
        $category->delete();

        $toast['type'] = 'info';
        $toast['message'] = 'Category Deleted!';
        return back()->with(['toast' => $toast]);
    }
}
