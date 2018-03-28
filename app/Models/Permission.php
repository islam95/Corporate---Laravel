<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles(){
        return $this->belongsToMany('Corp\Models\Role', 'permission_role');
    }
}
