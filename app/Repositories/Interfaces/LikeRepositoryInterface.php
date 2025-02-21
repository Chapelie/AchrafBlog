<?php
namespace App\Repositories\Interfaces;

use App\Models\Post;

interface LikeRepositoryInterface
{
    public function toggleLike(Post $post, $userId);
    public function countLikes(Post $post);
}
