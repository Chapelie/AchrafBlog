<?php
namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getCommentsForPost(Post $post)
    {
        return $post->comments()->with('user')->latest()->get();
    }

    public function createComment(Post $post, array $data)
    {
        return $post->comments()->create($data);
    }
}
