<?php

namespace Corp\Repositories;

use Corp\Models\Comment;

class CommentRepository extends Repository {

    public function __construct(Comment $comment) {
        $this->model = $comment; // Model is Comment
    }
}

