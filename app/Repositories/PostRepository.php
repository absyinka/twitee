<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Interfaces\IPostInterface;
use App\Traits\ResponseAPI;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Exception;

class PostRepository implements IPostInterface
{
    use ResponseAPI;

    /**
     * Display a listing of all posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return $this->success("All Posts: ", PostResource::collection(Post::with('comments')->get()));
    }

    /**
     * Create a post
     * 
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function create(StorePostRequest $request)
    {
        try {
            $post = Post::create([
                'user_id' => $request->user()->id,
                'content' => $request->content,
            ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

        return $this->success("Post created successfully", new PostResource($post));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) return $this->error("No post with ID: $id exist", 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

        return $this->success("Post detail:", new PostResource($post));
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        try {
            $post = Post::find($id);

            if (!$post) return $this->error("Post does not exist", 404);

            if ($request->user()->id !== $post->user_id) {
                return $this->error("You don't have access to delete this post: $post->content!", 403);
            }

            $post->delete();
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

        return $this->success("Post deleted", null, 204);
    }
}
