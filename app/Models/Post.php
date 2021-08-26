<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'content',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany('App\Models\LikeDislike', 'post_id')->sum('like');
    }

    public function dislikes()
    {
        return $this->hasMany('App\Models\LikeDislike', 'post_id')->sum('dislike');
    }
}
