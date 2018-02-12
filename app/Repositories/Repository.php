<?php

namespace Corp\Repositories;

use Config;

abstract class Repository {

    protected $model = false;

    // Gets all the data from given model (database table)
    public function get($select = '*', $take = false){
        $builder = $this->model->select($select);
        if($take){
            $builder->take($take);
        }
        return $this->check($builder->get());
    }

    // Decoding json format object in image fields of the db
    protected function check($result){
        if ($result->isEmpty()){
            return false;
        }
        $result->transform(function($model, $index) {
            if(is_string($model->img) && is_object(json_decode($model->img)) && (json_last_error() == JSON_ERROR_NONE)) {
                // json image fields in db
                $model->img = json_decode($model->img);
            }
            return $model;
        });
        return $result;
    }

}
