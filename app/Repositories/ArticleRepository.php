<?php

namespace Corp\Repositories;

use Corp\Models\Article;
use Illuminate\Support\Facades\Gate;

class ArticleRepository extends Repository {

    public function __construct(Article $article) {
        $this->model = $article; // Model is Article
    }

    public function one($alias, $attr = array()) {
        $article = parent::one($alias, $attr);
        if($article && !empty($attr)) {
            $article->load('comments');
            $article->comments->load('user');
        }
        return $article;
    }

    public function addArticle($request){
        if(Gate::denies('save', $this->model)){
            abort(403);
        }
        $data = $request->except('_token', 'image');
        if(empty($data)){
            return ['error' => 'No data'];
        }
    }

}