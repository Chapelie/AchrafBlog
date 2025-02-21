<?php
namespace App\Services;

use App\Models\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService                                                                                                    
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getComments(Post $post)
    {
        return $this->commentRepository->getCommentsForPost($post);
    }

    public function addComment(Post $post, $userId, $content)
    {
        return $this->commentRepository->createComment($post, [
            'user_id' => $userId,
            'content' => $content,
        ]);
    }
}
 