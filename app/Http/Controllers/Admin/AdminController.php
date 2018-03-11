<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Menu;

class AdminController extends Controller
{
    protected $projects;
    protected $articles;
    protected $user;
    protected $template;
    protected $content = false;
    protected $title;
    protected $vars;

    public function __construct(){
        $this->user = Auth::user();
        if(!$this->user){
            abort(403);
        }
    }

    public function renderOutput(){
        //create page title name and add to variables to pass to the template
        $this->vars = array_add($this->vars, 'title', $this->title);

        //create menu of the page
        $menu = $this->getMenu();
        $nav = view(env('THEME') .'.admin.nav')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'nav', $nav);

        // create content
        if($this->content){
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        // create footer
        $footer = view(env('THEME') .'.admin.footer')->render();
        $this->vars = array_add($this->vars,'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    public function getMenu(){
        return Menu::make('adminNav', function($menu) {
            $menu->add('Articles', array('route'=>'admin.articles.index'));
            $menu->add('Portfolio', array('route'=>'admin.articles.index'));
            $menu->add('Navigation', array('route'=>'admin.articles.index'));
            $menu->add('Users', array('route'=>'admin.articles.index'));
            $menu->add('Permissions', array('route'=>'admin.articles.index'));
        });
    }

}
