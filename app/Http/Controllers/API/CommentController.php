<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(Post $post)
    {
        return response()->json($this->commentService->getComments($post));
    }

    public function store(Request $request, Post $post)
    {
        $data = $request->validate(['content' => 'required|string']);

        $comment = $this->commentService->addComment($post, $request->user()->id, $data['content']);

        return response()->json($comment, 201);
    }
}
