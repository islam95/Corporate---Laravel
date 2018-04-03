<?php

namespace Corp\Repositories;

use Corp\Models\Article;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

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
        if($request->hasFile('image')){
            $image = $request->file('image');
            if($image->isValid()){
                $str = str_random(8);
                $obj = new \stdClass;
                $obj->mini = $str.'_mini.jpg';
                $obj->max = $str.'_max.jpg';
                $obj->path = $str.'.jpg';
                $img = Image::make($image);
                $img->fit(Config::get('settings.image')['width'],
                    Config::get('settings.image')['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->path);
                $img->fit(Config::get('settings.articles_img')['max']['width'],
                    Config::get('settings.articles_img')['max']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->max);
                $img->fit(Config::get('settings.articles_img')['mini']['width'],
                    Config::get('settings.articles_img')['mini']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->mini);
                $data['img'] = json_encode($obj);
                $this->model->fill($data);
                if($request->user()->articles()->save($this->model)){
                    return ['status' => 'Article has been successfully added!'];
                }
            }
        }
    }

}