<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;
use Corp\Models\Tag;

class Portfolio extends Model
{
    public function tag(){
        return $this->belongsTo('Tag', 'tag_alias', 'alias');
    }
}
