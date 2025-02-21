<?php
namespace App\Http\Controllers\Api;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPosts();
        return response()->json([
            'success' => true,
            'data' => $posts
        ], 200);
    }

    public function show($id): JsonResponse
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $post
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);
        $data['user_id'] = auth('api')->id();
        $post = $this->postService->createPost($data);

        return response()->json([
            'success' => true,
            'message' => 'Article créé avec succès',
            'data' => $post
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $post = $this->postService->updatePost($id, $data);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article mis à jour',
            'data' => $post
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->postService->deletePost($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article supprimé'
        ], 200);
    }
}
