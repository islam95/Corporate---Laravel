<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenuRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Menu;

class SiteController extends Controller
{
    protected $portfolios;
    protected $slides;
    protected $articles;
    protected $menus;
    protected $comments;

    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template;
    protected $vars = array();

    protected $sidebar_right = false;
    protected $sidebar_left = false;
    protected $sidebar = 'no';


    public function __construct(MenuRepository $menus){
        $this->menus = $menus;
    }

    /**
     * @return $this
     * @throws \Throwable
     */
    protected function renderOutput(){
        $menu = $this->getMenu();
        $nav = view(env('THEME') .'.includes.nav')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'nav', $nav);

        if ($this->sidebar_right){
            $sidebarRight = view(env('THEME') .'.includes.sidebarRight')->with('sidebar_right', $this->sidebar_right)->render();
            $this->vars = array_add($this->vars, 'sidebarRight', $sidebarRight);
        }

        if ($this->sidebar_left){
            $sidebarLeft = view(env('THEME') .'.includes.sidebarLeft')->with('sidebar_left', $this->sidebar_left)->render();
            $this->vars = array_add($this->vars, 'sidebarLeft', $sidebarLeft);
        }

        $this->vars = array_add($this->vars, 'sidebar', $this->sidebar);

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);

        $footer = view(env('THEME') .'.includes.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    // Menu links from the database
    protected function getMenu(){
        $menu = $this->menus->get(); // gets all the data from the Menu model (menus table in db)
        // used external plugin for menu creation: "laravel-menu"
        $myNav = \Menu::make('myNav', function($m) use ($menu) {
            foreach ($menu as $item){
                // if the item is parent (it's dropdown link)
                if($item->parent == 0){
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    // if sub-menu's parent is found
                    if ($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
        return $myNav;
    }

}
