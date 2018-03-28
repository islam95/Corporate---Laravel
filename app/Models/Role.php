<?php

namespace Corp\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->belongsToMany('Corp\Models\User');
    }

    public function permissions(){
        return $this->belongsToMany('Corp\Models\Permission', 'permission_role');
    }
}
