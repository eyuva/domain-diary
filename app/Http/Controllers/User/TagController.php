<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
        $data['tags'] = Tag::where('user_id','=',$user->id)->get();
        return view('tag.index',$data);
    }
    public function edit($id)
    {
        $user = auth()->user();
        $data['tag'] = Tag::where('user_id','=',$user->id)->findOrFail($id);
        return view('tag.edit',$data);
    }
    public function save()
    {
        $user = auth()->user();
        if(isset(request()->tag_id)){
            $tag = Tag::where('user_id','=',$user->id)->findOrFail(request()->tag_id);
            $message = 'Tag Updated!';
        }else{
            $tag = new Tag();
            $message = 'Tag Added!';
        }
        $tag->user_id = $user->id;
        $tag->name = request()->name;
        $tag->save();

        $toast['type'] = 'info';
        $toast['message'] = $message;
        return back()->with(['toast' => $toast]);
    }
    public function delete($id)
    {
        $user = auth()->user();
        $tag = Tag::where('user_id','=',$user->id)->findOrFail($id);
        $tag->delete();

        $toast['type'] = 'info';
        $toast['message'] = 'Tag Deleted!';
        return back()->with(['toast' => $toast]);
    }
}
