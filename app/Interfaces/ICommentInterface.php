<?php

namespace App\Interfaces;

use App\Http\Requests\CommentRequest;
use App\Models\Post;

interface ICommentInterface
{
    public function create(CommentRequest $request, Post $post);

    public function delete($post_id, $id);
}
