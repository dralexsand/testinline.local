<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\Post;

class PostService extends ServiceAbstract
{
    public function __construct()
    {
        $this->setModel(new Post());
    }

}
