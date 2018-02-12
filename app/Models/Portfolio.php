<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function tag(){
        return $this->belongsTo('Corp\Models\Tag', 'tag_alias', 'alias');
    }
}
