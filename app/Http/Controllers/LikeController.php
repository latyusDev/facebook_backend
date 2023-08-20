<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function index()
    {
        return Like::count();
    }

    public function store(Post $post)
    {

        $like = Like::firstOrNew([
                  'user_id' => auth()->user()->id,
                  'likeable_type' => Post::class,
                  'likeable_id' => $post->id,
                ]);
        
        $success = false;
            
       if($like->id){
        $like->delete();
       }else{
        $success = $like->save();
       }
       return  $success ;
    }


    
    public function commentLike(Comment $comment)
    {

    $like = Like::firstOrNew([
            'user_id' => auth()->user()->id,
            'likeable_type' => Comment::class,
            'likeable_id' => $comment->id,
            ]);
        
    $success = false;
            
    if($like->id){
        $like->delete();
     }else{
        $success = $like->save();
     }
       return  $success ;
    }

}
