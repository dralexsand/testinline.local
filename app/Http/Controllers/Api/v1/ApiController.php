<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    protected PostService $postService;
    protected CommentService $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    public function getPosts(Request $request): array
    {
        if (!($request->input('url'))) {
            return [
                'success' => false,
                'data' => [],
                'count' => 0,
            ];
        }

        $url = $request->input('url');
        $response = Http::get($url);
        $data = json_decode($response, true);

        $keys = [
            'userId' => 'user_id'
        ];
        $data = $this->postService::changeArrayKeys($data, $keys);

        $this->postService->store($data);

        return [
            'success' => true,
            'data' => $response,
            'count' => count($data),
        ];
    }

    public function getComments(Request $request): array
    {
        if (!($request->input('url'))) {
            return [
                'success' => false,
                'data' => [],
                'count' => 0,
            ];
        }

        $url = $request->input('url');
        $response = Http::get($url);
        $data = json_decode($response, true);

        $keys = [
            'postId' => 'post_id'
        ];
        $data = $this->commentService::changeArrayKeys($data, $keys);

        $this->commentService->store($data);

        return [
            'success' => true,
            'data' => $response,
            'count' => count($data),
        ];
    }

    public function clearDataDb(): array
    {
        DB::table('posts')->truncate();
        DB::table('comments')->truncate();

        return [
            'success' => true,
        ];
    }

}
