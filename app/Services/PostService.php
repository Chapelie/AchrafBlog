<?php
namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function createPost($data)
    {
        return $this->postRepository->createPost($data);
    }

    public function updatePost($id, $data)
    {
        return $this->postRepository->updatePost($id, $data);
    }

    public function deletePost($id)
    {
        return $this->postRepository->deletePost($id);
    }
}
