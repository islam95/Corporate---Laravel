<?php

namespace Corp\Repositories;

use Config;

abstract class Repository {

    protected $model = false;

    // Gets all the data from given model (database table)
    public function get(){
        $builder = $this->model->select('*');
        return $builder->get();
    }

}
