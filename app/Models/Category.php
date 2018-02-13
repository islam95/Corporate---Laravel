<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    // 1:* - 1 category can be assigned to Many articles in the blog
    public function articles()
    {
        return $this->hasMany('Corp\Article');
    }

}
