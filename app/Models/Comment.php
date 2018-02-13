<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // 1:1 - 1 comment can only be assigned to 1 article
    public function article(){
        return $this->belongsTo('Corp\Article');
    }

    // 1:1 - 1 comment can only be assigned to 1 user
    public function user(){
        return $this->belongsTo('Corp\User');
    }

}
