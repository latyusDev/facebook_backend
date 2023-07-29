<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentReplyController extends Controller
{
    public function index($id)
    {
            return Comment::with('likes')
                          ->where('parent_id',$id)
                          ->get();
    }

    public function store(Post $post, Comment $comment, Request $request)
    {
        $comment = [
            'body' => $request->body,
            'user_id' => $request->user()->id,
            'parent_id' => $comment->id
        ];
        return $post->comments()->create($comment);
    }}
