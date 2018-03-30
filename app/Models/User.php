<?php

namespace Corp\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 1:* - 1 user can write Many articles to the blog
    public function articles(){
        return $this->hasMany('Corp\Models\Article');
    }

    // 1:* - 1 user can write Many comments on the article
    public function comments(){
        return $this->hasMany('Corp\Models\Comment');
    }

    public function roles(){
        return $this->belongsToMany('Corp\Models\Role', 'user_role');
    }

    // can be 'string' or array('VIEW_ADMIN', 'ADD_ARTICLES')
    public function canDo($permission, $require = false){
        if(is_array($permission)){
            foreach ($permission as $permName){
                $permName = $this->canDo($permName); // recursion
                if($permName && !$require){
                    return true;
                } elseif (!$permName && $require){
                    return false;
                }
            }
            return $require;
        } else {
            foreach($this->roles()->get() as $role){
                foreach ($role->permissions()->get() as $perm){
                    if(str_is($permission, $perm->name)){
                        return true;
                    }
                }
            }
        }
    }

    // string  or ['role1', 'role2']
    public function hasRole($name, $require = false){
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);
                if ($hasRole && !$require) {
                    return true;
                } elseif (!$hasRole && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->roles as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }
        return false;
    }

}
