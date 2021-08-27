<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    protected $fillable = ['user_id', 'post_id', 'like', 'dislike'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
