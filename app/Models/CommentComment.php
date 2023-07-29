<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentComment extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'user_id', 'body'];


    public function comments() 
    {

        return $this->belongsTo(CommentComment::class);
    }

    public function replies()
    {
            return $this->hasMany(Reply::class);
    }

    public function likes()
    {
            return $this->morphMany(Like::class, 'likeable');
    }
}
