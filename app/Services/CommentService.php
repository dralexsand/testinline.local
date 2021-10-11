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

    public function selectedSearchText(Collection $records, string $searchText): array
    {
        $selectedRecords = [];
        $replacedText = "<strong class='selected_text'>$searchText</strong>";

        foreach ($records as $key => $record) {
            $newBody = str_replace($searchText, $replacedText, $record->body);
            $newRecord = $record;
            $newRecord->setBody($newBody);
            $selectedRecords[$key] = $newRecord;
        }

        return $selectedRecords;
    }

    public function getRecord($postTitle, $commentName, $commentBody, $commentEmail)
    {
        return view("components.record", [
            'post_title' => $postTitle,
            'comment_name' => $commentName,
            'comment_body' => $commentBody,
            'comment_email' => $commentEmail
        ]);
    }

}
