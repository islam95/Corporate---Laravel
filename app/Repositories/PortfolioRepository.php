<?php

namespace Corp\Repositories;

use Corp\Models\Portfolio;

class PortfolioRepository extends Repository {

    public function __construct(Portfolio $portfolio) {
        $this->model = $portfolio; // Model is Portfolio
    }
}