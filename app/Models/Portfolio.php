<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    // 1:1 - 1 Portfolio project can have only 1 tag
    public function tag(){
        return $this->belongsTo('Corp\Models\Tag', 'tag_alias', 'alias');
    }
}
