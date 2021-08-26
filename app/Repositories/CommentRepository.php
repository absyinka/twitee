<?php

namespace App\Repositories;

use App\Http\Requests\CommentRequest;
use App\Traits\ResponseAPI;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Interfaces\ICommentInterface;
use Exception;

class CommentRepository implements ICommentInterface
{
    use ResponseAPI;

    /**
     * Add a comment
     * 
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function create(CommentRequest $request, Post $post)
    {
        try {
            $comment = new Comment;

            $comment->user_id = $request->user()->id;

            $comment->post_id = $post->id;

            $comment->comment_text = $request->comment_text;

            $comment->save();

            // $post->comments()->save($comment);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

        return $this->success("Comment added successfully", new CommentResource($comment));
    }


    /**
     * Remove the specified rating from storage.
     *
     * @param  \App\Models\Comment  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($post_id, $id)
    {
        try {
            $comment = Comment::find($id);

            $post = Post::find($post_id);

            if (!$comment || !$post) return $this->error("Rating or book does not exist", 404);

            if (!$comment && !$post) return $this->error("Rating and book does not exist", 404);

            if (auth()->user()->id != $post->user_id)  return $this->error("You don't have access to delete this rating!", 403);

            $comment->delete();
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

        return $this->success("Comment deleted", null, 204);
    }
}
