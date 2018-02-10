<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenuRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class SiteController extends Controller
{
    protected $portfolios;
    protected $sliders;
    protected $articles;
    protected $menus;

    protected $template;
    protected $vars = array();

    protected $sidebar_right = false;
    protected $sidebar_left = false;
    protected $sidebar = false;

    public function __construct(MenuRepository $menus){
        $this->menus = $menus;
    }

    protected function renderOutput(){

        $menu = $this->getMenu();

        $nav = view(env('THEME') .'.includes.nav')->render();
        $this->vars = array_add($this->vars, 'nav', $nav);

        return view($this->template)->with($this->vars);
    }

    protected function getMenu(){
        $menu = $this->menus->get();

        return $menu;
    }

}
