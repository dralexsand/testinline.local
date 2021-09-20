<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    protected $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    public function index()
    {
        $isEmptyPosts = $this->postService->isEmpty();
        $isEmptyComments = $this->commentService->isEmpty();

        $posts = [];
        $comments = [];

        if ($isEmptyPosts && $isEmptyComments) {
            $posts = $this->postService->getAll();
            $comments = $this->commentService->getAll();
        }

        $isData = $isEmptyPosts && $isEmptyComments;

        //$message_info = "Данные posts успешно загружены";

        return view('pages.home', [
            'isEmptyPosts' => $isEmptyPosts,
            'isEmptyComments' => $isEmptyComments,
            'posts' => $posts,
            'comments' => $comments,
            'message_info' => '',
            'isData' => $isData,
        ]);
    }
}
