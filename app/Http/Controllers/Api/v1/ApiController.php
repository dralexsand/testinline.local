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
    protected $postService;
    protected $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    public function getPosts(Request $request)
    {
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
            'count' => sizeof($data),
        ];
    }

    public function getComments(Request $request)
    {
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
            'count' => sizeof($data),
        ];
    }

    public function clearDataDb()
    {
        DB::table('posts')->truncate();
        DB::table('comments')->truncate();

        return [
            'success' => true,
        ];
    }

}
