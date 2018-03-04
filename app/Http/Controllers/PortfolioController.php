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
        $this->title = 'Portfolio';
        $projects = $this->getProjects();
        $content = view(env('THEME') .'.portfolio.main')->with('projects', $projects)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function getProjects($take = false, $pagination = true){
        $projects = $this->portfolios->get('*', $take, $pagination);
        if($projects) {
            // for overload of sql queries in the same page
            $projects->load('tag'); // loads all these Models prior to the page load
        }
        return $projects;
    }

    public function show($alias){
        $project = $this->portfolios->one($alias);

        $projects = $this->getProjects(config('settings.projects_number'), false);

        $this->title = $project->title;

        $content = view(env('THEME') .'.portfolio.project')->with(['project' => $project, 'projects' => $projects])->render();
        $this->vars = array_add($this->vars,'content',$content);

        return $this->renderOutput();
    }


}
