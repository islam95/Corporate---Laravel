<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Corp\Repositories\SliderRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Illuminate\Support\Facades\Config;

class IndexController extends SiteController
{
    public function __construct(SliderRepository $slides, PortfolioRepository $portfolios, ArticleRepository $articles){
        parent::__construct(new MenuRepository(new Menu())); // calling the parent constructor of SiteController.
        $this->slides = $slides;
        $this->portfolios = $portfolios;
        $this->articles = $articles;
        $this->sidebar = 'right'; // used for right sidebar of the page as class name "sidebar-right".
        $this->template = env('THEME') . '.index'; // template of this controller is pink/index.blade.php
    }

    /**
     * Display a listing of the resource.
     *
     * @return IndexController
     * @throws \Throwable
     */
    public function index()
    {
        $sliderItems = $this->getSlides();
        $slides = view(env('THEME') .'.includes.slider')->with('slides', $sliderItems)->render();
        $this->vars = array_add($this->vars, 'slides', $slides); // adding $slides to array of vars to pass to the view.

        $portfolio = $this->getPortfolio();
        $content = view(env('THEME') .'.includes.content')->with('portfolio', $portfolio)->render();
        $this->vars = array_add($this->vars, 'content', $content); // adding $content to array of vars to pass to the view.

        $articles = $this->getArticles();
        $this->sidebar_right = view(env('THEME') .'.indexSidebar')->with('articles', $articles)->render();

        return $this->renderOutput();
    }

    // gets all the slides from db using SliderRepository
    public function getSlides() {
        $slides = $this->slides->get();
        return $slides;
    }

    // gets portfolio data from db using PortfolioRepository
    protected function getPortfolio() {
        // Get first 5 portfolio projects (see settings config for a number)
        $portfolio = $this->portfolios->get('*', Config::get('settings.home_number_portfolio'));
        return $portfolio;
    }

    // gets articles from db using ArticleRepository
    protected function getArticles() {
        $articles = $this->articles->get(['title', 'created_at', 'img', 'alias'], Config::get('settings.home_number_articles'));
        return $articles;
    }

}
