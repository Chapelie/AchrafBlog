<?php
namespace App\Services;

use App\Models\Post;
use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function toggleLike(Post $post, $userId)
    {
        return $this->likeRepository->toggleLike($post, $userId);
    }

    public function getLikeCount(Post $post)
    {
        return $this->likeRepository->countLikes($post);
    }
}
