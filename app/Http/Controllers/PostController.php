<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Interfaces\IPostInterface;

/**
 * @group Post
 *
 * API endpoints for managing Post
 */
class PostController extends Controller
{
    protected $postInterface;

    public function __construct(IPostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    /**
     * @OA\Get(
     *      path="/posts",
     *      operationId="allPosts",
     *      tags={"Posts"},
     *      summary="Get list of posts",
     *      description="Returns list of posts",
     *      @OA\Response(
     *          response=200,
     *          description="All Posts",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="username", type="string", example="Jon Write"),
     *              @OA\Property(property="title", type="string", example="The goldie is back"),
     *              )
     *       ),
     *     )
     */
    public function getAll()
    {
        return $this->postInterface->getAll();
    }

    /**
     * @OA\Post(
     * path="/post",
     * summary="Create a post",
     * description="User create a post",
     * operationId="createPost",
     * tags={"Post"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Provide post details",
     *    @OA\JsonContent(
     *       required={"content"},
     *       @OA\Property(property="content", type="string", example="The goldie is back"),
     *    ),
     * ),
     * 
     * @OA\Response(
     *    response=200,
     *    description="Post created successfully!",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="integer", example="1"),
     *       @OA\Property(property="username", type="string", example="Jon Write"),
     *       @OA\Property(property="title", type="string", example="The goldie is back"),
     *        )
     *     ),
     * 
     * @OA\Response(
     *    response=422,
     *    description="Fields are required",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="fields are required")
     *        )
     *     ),
     * )
     */
    public function create(StorePostRequest $request)
    {
        return $this->postInterface->create($request);
    }


    /**
     * @OA\Get(
     *      path="/post/{id}",
     *      operationId="getPostDetail",
     *      tags={"Post"},
     *      summary="Get a post detail",
     *      description="Returns detail of a particular post",
     *      @OA\Response(
     *          response=200,
     *          description="Post detail:",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="username", type="string", example="Jon Write"),
     *              @OA\Property(property="title", type="string", example="The goldie is back"),
     *              )
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="Post not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="post does not exist"),
     *              )
     *       ),
     *     )
     */
    public function detail($id)
    {
        return $this->postInterface->getById($id);
    }

    /**
     * @OA\Delete(
     *      path="/post/{id}",
     *      operationId="deletePost",
     *      tags={"Post"},
     *      summary="Delete a post",
     *      description="Delete a post along with it's comments",
     *      @OA\Response(
     *          response=204,
     *          description="No content",
     *       ),
     * 
     *      @OA\Response(
     *          response=404,
     *          description="Post not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Post does not exist"),
     *              )
     *       ),
     * 
     *     @OA\Response(
     *          response=403,
     *          description="Access forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="You don't have access to delete this post: The goldie is back!"),
     *              )
     *       ),
     *     )
     */
    public function delete(Request $request, $id)
    {
        return $this->postInterface->delete($request, $id);
    }
}
