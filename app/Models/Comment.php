<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['post_id', 'parent_id', 'user_id', 'body'];

    
    public function replies() 
    {

        return $this->hasMany(Reply::class);
    }   

    public function commentComments() 
    {

        return $this->hasMany(CommentComment::class);
    }

    public function post() 
    {
        
        return $this->belongsTo(Post::class);
    }
    
    public function likes() 
    {

        return $this->morphMany(Like::class, 'likeable');
    }   
}
