<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\CommentRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class ArticlesController extends SiteController
{
    public function __construct(PortfolioRepository $portfolios, ArticleRepository $articles, CommentRepository $comments){
        parent::__construct(new MenuRepository(new Menu())); // calling the parent constructor of SiteController.
        $this->portfolios = $portfolios;
        $this->articles = $articles;
        $this->comments = $comments;
        $this->sidebar = 'right'; // used for right sidebar of the page as class name "sidebar-right".
        $this->template = env('THEME') . '.blog'; // template of this controller is pink/blog.blade.php
    }

    /**
     * @return $this
     * @throws \Throwable
     */
    public function index(){
        // ------------------- Content of the main blog page --------------------
        $articles = $this->getArticles();
        $content = view(env('THEME') .'.blog.blog_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        // ------------------- Sidebar of the main blog page --------------------
        $comments = $this->getComments(config('settings.recent_comments_number'));
        $projects = $this->getProjects(config('settings.recent_projects_number'));
        $this->sidebar_right = view(env('THEME') .'.blog.blog_sidebar')->with(['comments'=>$comments, 'projects'=>$projects]);

        return $this->renderOutput();
    }

    public function getArticles($alias = false) {
        $articles = $this->articles->get('*',false, true);
        if($articles) {
            //$articles->load('user', 'category', 'comments');
        }
        return $articles;
    }

    public function getComments($take){
        $comments = $this->comments->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);
        return $comments;
    }

    public function getProjects($take){
        $projects = $this->portfolios->get(['title', 'text', 'alias', 'customer', 'img', 'tag_alias'], $take);
        return $projects;
    }


}
