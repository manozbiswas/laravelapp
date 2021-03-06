<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
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

    function address()
    {
        return $this->hasOne('App\Address');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
