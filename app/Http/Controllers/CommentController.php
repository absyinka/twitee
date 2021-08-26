<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Interfaces\ICommentInterface;
use App\Models\Post;

/**
 * @group State
 *
 * API endpoints for managing state
 */
class CommentController extends Controller
{
    protected $commentInterface;

    public function __construct(ICommentInterface $commentInterface)
    {
        $this->commentInterface = $commentInterface;
    }

    /**
     * @OA\Post(
     * path="/comment/{post}",
     * summary="Add a comment",
     * description="Add comment to a post",
     * operationId="addComment",
     * tags={"Comment"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Add a comment",
     *    @OA\JsonContent(
     *       required={"comment_text"},
     *       @OA\Property(property="comment_text", type="string", example="This is a comment text"),
     *    ),
     * ),
     * 
     * @OA\Response(
     *    response=200,
     *    description="Comment added successfully!",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="integer", example="1"),
     *       @OA\Property(property="user_id", type="integer", example="1"),
     *       @OA\Property(property="post_id", type="integer", example="4"),
     *       @OA\Property(property="comment_text", type="string", example="test comment"),
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
    public function create(CommentRequest $request, Post $post)
    {
        return $this->commentInterface->create($request, $post);
    }

    /**
     * @OA\Delete(
     * path="comment/{post_id}/{id}",
     * summary="Delete comment",
     * description="Delete comment on a post",
     * operationId="deleteComment",
     * tags={"comment"},
     * description="Delete post comment",
     * 
     * @OA\Response(
     *     response=204,
     *     description="No content",
     *  ),
     * 
     * @OA\Response(
     *    response=404,
     *    description="Post or comment not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Post or comment does not exist")
     *        )
     *     ),
     * 
     * @OA\Response(
     *          response=403,
     *          description="Access forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="You don't have access to delete this comment!"),
     *              )
     *       ),
     * )
     */
    public function delete($post_id, $id)
    {
        return $this->commentInterface->delete($post_id, $id);
    }
}
