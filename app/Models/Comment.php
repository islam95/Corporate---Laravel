<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['name','text','site','user_id','article_id','parent_id','email'];

    // 1:1 - 1 comment can only be assigned to 1 article
    public function article(){
        return $this->belongsTo('Corp\Models\Article');
    }

    // 1:1 - 1 comment can only be assigned to 1 user
    public function user(){
        return $this->belongsTo('Corp\Models\User');
    }

}
