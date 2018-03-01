<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;

class PortfolioController extends SiteController
{
    public function __construct(PortfolioRepository $portfolios){
        parent::__construct(new MenuRepository(new Menu()));
        $this->portfolios = $portfolios;
        $this->template = env('THEME') . '.portfolio';
    }

    /**
     * @return $this
     * @throws \Throwable
     */
    public function index(){
        // ------------------- Content of the main Portfolio page --------------------
        $content = view(env('THEME') .'.portfolio.main')->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $this->title = 'Portfolio';

        return $this->renderOutput();
    }


}
