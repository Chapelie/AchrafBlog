<?php
namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggle(Request $request, Post $post)
    {
        $liked = $this->likeService->toggleLike($post, auth('api')->id());

        return response()->json([
            'message' => $liked ? 'Like ajouté' : 'Like supprimé',
            'likes_count' => $this->likeService->getLikeCount($post),
        ]);
    }
    public function count(Post $post)
    {
        return response()->json([
            'likes_count' => $this->likeService->getLikeCount($post),
        ]);
    }
}
