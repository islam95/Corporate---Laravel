<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 1:1 - 1 article can be assigned only to 1 user
    public function user()
    {
        return $this->belongsTo('Corp\Models\User');
    }

    // 1:1 - 1 article can only have 1 category
    public function category()
    {
        return $this->belongsTo('Corp\Models\Category');
    }

    // 1:* - 1 article can have Many comments
    public function comments()
    {
        return $this->hasMany('Corp\Models\Comment');
    }

}
