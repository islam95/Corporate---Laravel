<?php

namespace Corp\Repositories;

use Corp\Models\Article;

class ArticleRepository extends Repository {

    public function __construct(Article $article) {
        $this->model = $article; // Model is Article
    }
}