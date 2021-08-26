<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    protected $fillable = ['user_id', 'post_id', 'like', 'dislike'];
}
