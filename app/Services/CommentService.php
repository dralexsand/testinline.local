<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;


class CommentService extends ServiceAbstract
{
    public function __construct()
    {
        $this->setModel(new Comment());
    }

    public function getSearchText($text)
    {
        return Comment::where('body', 'LIKE', '%' . $text . '%')
            ->with('post')
            ->get();
    }

    public function selectedSearchText(Collection $records, string $search_text): array
    {
        $selected_records = [];
        $replaced_text = "<strong class='selected_text'>$search_text</strong>";

        foreach ($records as $key => $record) {
            $new_body = str_replace($search_text, $replaced_text, $record->body);
            $new_record = $record;
            $new_record->setBody($new_body);
            $selected_records[$key] = $new_record;
        }

        return $selected_records;
    }

    public function getRecord($post_title, $comment_name, $comment_body, $comment_email)
    {
        return '<div class="card">
    <h5 class="card-header">{{ $post_title }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $comment_name }}</h5>
        <p class="card-text">{{ $comment_body }}</p>
        <footer><cite title="Source Title">{{ $comment_email }}</cite></footer>
    </div>
</div>';
    }
}
