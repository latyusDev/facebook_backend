<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index(){

        $posts = Post::with(['likes', 'comments' => fn($query) =>
                 $query->with('likes')    
                       ->whereNull('parent_id')])
                       ->get();
      
        return $posts;
    }


    public function store(Request $request){

       $post = $request->validate([
            'body' => 'required'
        ]);
  
        if($request->hasFile('image')){

            $post['image'] = url('/storage/'.$request->file('image')->store('image', 'public'));
        }
         
        return $request->user()->posts()->create($post);
    }

   
}
