<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\Comment;


class CommentService extends ServiceAbstract
{
    public function __construct()
    {
        $this->setModel(new Comment());
    }

    public function getSampleComments(): array
    {
        $count = 13;
        $i = 1;
        $comments = [];

        while ($i <= $count) {
            $comments[] = [
                'post_title' => 'Post Title',
                'comment_name' => 'enim asperiores illum',
                'comment_body' => 'soluta quia porro mollitia eos accusamus\nvoluptatem illo perferendis earum quia\nquo sed ipsam in omnis cum earum tempore eos\nvoluptatem illum doloremque corporis ipsam facere',
                'comment_email' => 'Lorenza.Carter@consuelo.ca',
                'comment_id' => $i,
            ];
            $i++;
        }
        return $comments;
    }

}
