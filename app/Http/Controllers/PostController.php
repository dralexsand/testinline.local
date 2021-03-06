<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;
    protected CommentService $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    public function index(Request $request)
    {
        $isEmptyPosts = $this->postService->isEmpty();
        $isEmptyComments = $this->commentService->isEmpty();

        $posts = [];
        $comments = [];
        $messageInfo = "";
        $text = "";

        if ($isEmptyPosts && $isEmptyComments) {
            $posts = $this->postService->getAll();

            if (isset($request->text_search)
                && trim($request->text_search) !== ''
                && strlen(trim($request->text_search)) >= 3
            ) {
                $text = $request->input('text_search');
                $comments = $this->commentService->getSearchText($text);
                $comments = $this->commentService->selectedSearchText($comments, $text);
            } else {
                $comments = $this->commentService->getAll();
            }

            $commentsCount = count($comments);
            $messageInfo = "Найдено $commentsCount комментариев";
        }

        $isData = $isEmptyPosts && $isEmptyComments;

        return view('pages.home', [
            'isEmptyPosts' => $isEmptyPosts,
            'isEmptyComments' => $isEmptyComments,
            'posts' => $posts,
            'comments' => $comments,
            'message_info' => $messageInfo,
            'isData' => $isData,
            'text' => $text,
        ]);
    }
}
