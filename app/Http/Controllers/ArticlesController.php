<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class ArticlesController extends SiteController
{
    public function __construct(PortfolioRepository $portfolios, ArticleRepository $articles){
        parent::__construct(new MenuRepository(new Menu())); // calling the parent constructor of SiteController.
        $this->portfolios = $portfolios;
        $this->articles = $articles;
        $this->sidebar = 'right'; // used for right sidebar of the page as class name "sidebar-right".
        $this->template = env('THEME') . '.blog'; // template of this controller is pink/blog.blade.php
    }

    /**
     * @return $this
     * @throws \Throwable
     */
    public function index(){
        $articles = $this->getArticles();
        $content = view(env('THEME') .'.blog.blog_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();
    }

    public function getArticles($alias = false) {
        $articles = $this->articles->get('*',false, true);
        if($articles) {
            //$articles->load('user', 'category', 'comments');
        }
        return $articles;
    }


}
