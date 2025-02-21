<?php
namespace App\Repositories\Interfaces;

use App\Models\Post;

interface CommentRepositoryInterface
{
    public function getCommentsForPost(Post $post);
    public function createComment(Post $post, array $data);
}
