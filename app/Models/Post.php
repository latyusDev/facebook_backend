<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
    'image',
    'body',
    ];
    
    // protected $dateFormat = 'U';

    protected $casts = [ 'created_at'=>'datetime'];



    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function comments()
    {
        
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
}
