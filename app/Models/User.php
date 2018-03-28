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
}
