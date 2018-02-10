<?php

namespace Corp\Repositories;

use Corp\Models\Menu;

class MenuRepository extends Repository {

    public function __construct(Menu $menu) {
        $this->model = $menu;
    }

}

