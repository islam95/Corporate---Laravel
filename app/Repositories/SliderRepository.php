<?php

namespace Corp\Repositories;

use Corp\Models\Slider;

class SliderRepository extends Repository {

    public function __construct(Slider $slider) {
        $this->model = $slider; // Model is Menu
    }
}