<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::get() ;

        return view('posts.post', ["categories" => $categories]);
    }
    public function add_post(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
            'image' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = new Post;    
        $post->user_id = Auth::user()->id ;
        $post->post_title = $request->title ;    
        $post->post_body = $request->body ;    
        $post->category_id = $request->category ;    
        if($request->hasFile('image')){
            $image = $request->file('image');    
            $image->move(public_path().'/Images/Posts/', $image->getClientOriginalName());
            $url = '/Images/Posts' . $image->getClientOriginalName(); 
            $post->post_image = $url;
            $post->save();
            return redirect('/post')->with('response', 'Post was shared successfully');
        }  
        return redirect('/post')->with('danger', 'Obss! try again plz');  
    }
}
