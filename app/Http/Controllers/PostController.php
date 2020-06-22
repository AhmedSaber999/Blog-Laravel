<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::get() ;

        return view('posts.post', ["categories" => $categories]);
    }
    public function add(Request $request)
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
            $url = '/Images/Posts/' . $image->getClientOriginalName(); 
            $post->post_image = $url;
            $post->save();
            return redirect('/post')->with('response', 'Post was shared successfully');
        }  
        return redirect('/post')->with('danger', 'Obss! try again plz');  
    }

    public function edit_post(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
            'image' => 'required',
            'title' => 'required',
            'body' => 'required',
            'post_id' => 'required',
        ]);
        $post = Post::where('id', $request->post_id)->first();    
        $post->user_id = Auth::user()->id ;
        $post->post_title = $request->title ;    
        $post->post_body = $request->body ;    
        $post->category_id = $request->category ;    
        if($request->hasFile('image')){
            $image = $request->file('image');    
            $image->move(public_path().'/Images/Posts/', $image->getClientOriginalName());
            $url = '/Images/Posts/' . $image->getClientOriginalName(); 
            $post->post_image = $url;
            $post->update();
            return redirect('/home')->with('response', 'Post has peen updated successfully');
        }  
        return back()->with('danger', 'Obss! try again plz');  
    }
    public function view($post_id)
    {
        if($post_id){
            $post = Post::where('id', $post_id)->first();
            if($post){
                return view('posts.view', ["post" => $post]);
            }
            return redirect('/home')->with('danger', 'No posts have been found');       
        }
        return back();
    }
    public function edit($post_id)
    {
        if($post_id){
            $post = Post::where('id', $post_id)->first();
            if($post){
                $categories = Category::get() ; 
                return view('posts.edit', ["post" => $post, "categories" => $categories]);
            }
            return redirect('/home')->with('danger', 'No posts have been found');       
        }
        return back();
    }
    public function delete(Request $request)
    {
        $this->validate($request,[
            'post_id' => 'required',
        ]);
        if($request->post_id){
            $post = Post::where('id', $request->post_id)->first();
            if($post){
                $post->delete();
                return redirect('/home')->with('response', 'Post has been deleted successfully');       
            }
            return redirect('/home')->with('danger', 'No posts have been found');       
        }
        return back();
    }
}
