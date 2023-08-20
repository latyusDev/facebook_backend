<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
            $this->validate($request, [
                'body' => 'required'
            ]);
            $comment = [
                'body' => $request->body,
                'user_id' => $request->user()->id
            ];
    
            return $post->comments()->create($comment);


    }

   
}
