<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function isModerator() {
    //     return $this->role === 'moderator';
    // }
 
    // public function isMember() {
    //     return $this->role === 'member';
    // }

    function reviews() {
        return $this->belongsToMany('App\Models\Product', 'reviews')
        ->withPivot('id')
        ->withPivot('review_rating')
        ->withPivot('review_content')
        ->withPivot('like_count')
        ->withPivot('dislike_count')
        ->withPivot('user_name')
        ->withTimestamps();
    }

    function followed() { // get all the user that the current user is following
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_user_id', 'followed_user_id')
        ->withPivot('followed_user_name')
        ->withTimestamps();
    }

    function follower() { // get all the user that is following the current user
        return $this->belongsToMany('App\Models\User', 'follows', 'followed_user_id', 'follower_user_id')
        ->withTimestamps();
    }
}

// the hasMany() bracket need 2 arguments:
// 1. ('where's the target model?', 
// 2. 'find the record in the target table where user_id (maybe user_id the 1st parameter from the user table) = what? --> need to specify! ex. user_id = follower_user_id)