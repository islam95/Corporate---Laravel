<?php

namespace Corp\Http\Controllers;

use Corp\Models\Category;
use Corp\Models\Menu;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\CommentRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class ArticlesController extends SiteController {

    public function __construct(PortfolioRepository $portfolios, ArticleRepository $articles, CommentRepository $comments){
        parent::__construct(new MenuRepository(new Menu())); // calling the parent constructor of SiteController.
        $this->portfolios = $portfolios;
        $this->articles = $articles;
        $this->comments = $comments;
        $this->sidebar = 'right'; // used for right sidebar of the page as class name "sidebar-right".
        $this->template = env('THEME') . '.blog'; // template of this controller is pink/blog.blade.php
    }

    /**
     * @param bool $cat_alias
     *
     * @return $this
     * @throws \Throwable
     */
    public function index($cat_alias = false){
        // ------------------- Content of the main blog page --------------------
        $articles = $this->getArticles($cat_alias);
        $content = view(env('THEME') .'.blog.blog_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        // ------------------- Sidebar of the main blog page --------------------
        $comments = $this->getComments(config('settings.recent_comments_number'));
        $projects = $this->getProjects(config('settings.recent_projects_number'));
        $this->sidebar_right = view(env('THEME') .'.blog.blog_sidebar')->with(['comments'=>$comments, 'projects'=>$projects]);

        return $this->renderOutput();
    }

    public function getArticles($alias = false) {
        $where = false;
        if ($alias){
            // WHERE `alias` = $alias
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            // WHERE `category_id` = $id
            $where = ['category_id', $id];
        }

        $articles = $this->articles->get('*',false, true, $where);
        if($articles) {
            // for overload of sql queries in the same page
            $articles->load('user', 'category', 'comments'); // loads all these Models prior to the page load
        }
        return $articles;
    }

    public function getComments($take){
        $comments = $this->comments->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);
        if($comments) {
            // for overload of sql queries in the same page
            $comments->load('user', 'article'); // loads all these Models prior to the page load
        }
        return $comments;
    }

    public function getProjects($take){
        $projects = $this->portfolios->get(['title', 'text', 'alias', 'customer', 'img', 'tag_alias'], $take);
        return $projects;
    }

    public function show($alias = false){
        $article = $this->articles->one($alias, ['comments' => true]);
        //dd($article);
        $content = view(env('THEME') .'.blog.article')->with('article', $article)->render();
        $this->vars = array_add($this->vars,'content',$content);

        $comments = $this->getComments(config('settings.recent_comments_number'));
        $projects = $this->getProjects(config('settings.recent_projects_number'));
        $this->sidebar_right = view(env('THEME') .'.blog.blog_sidebar')->with(['comments'=>$comments, 'projects'=>$projects]);

        return $this->renderOutput();
    }

}
