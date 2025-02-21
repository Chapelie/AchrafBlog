<?php
namespace App\Repositories\Eloquent;

use App\Models\Like;
use App\Models\Post;
use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggleLike(Post $post, $userId)
    {
        $like = Like::where('post_id', $post->id)->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return false;
        }

        Like::create([
            'post_id' => $post->id,
            'user_id' => $userId,
        ]);

        return true;
    }

    public function countLikes(Post $post)
    {
        return $post->likes()->count();
    }
}

