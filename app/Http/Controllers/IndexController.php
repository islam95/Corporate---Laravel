<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\SliderRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class IndexController extends SiteController
{
    public function __construct(SliderRepository $slides){
        parent::__construct(new MenuRepository(new Menu())); // calling the parent constructor of SiteController.
        $this->slides = $slides;
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
        return $this->renderOutput();
    }

    // gets all the slides from db using SliderRepository
    public function getSlides() {
        $slides = $this->slides->get();
        return $slides;
    }

}
