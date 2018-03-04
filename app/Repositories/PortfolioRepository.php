<?php

namespace Corp\Repositories;

use Corp\Models\Portfolio;

class PortfolioRepository extends Repository {

    public function __construct(Portfolio $portfolio) {
        $this->model = $portfolio; // Model is Portfolio
    }

    public function one($alias, $attr = array()){
        $project = parent::one($alias, $attr);

        if($project && $project->img){
            $project->img = json_decode($project->img);
        }

        return $project;
    }


}