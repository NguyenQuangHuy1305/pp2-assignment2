<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // function users() {
    //     return $this->belongsToMany('App\Models\User', 'reviews')->withPivot('id')->withPivot('review_rating')->withPivot('review_content')->withTimestamps();
    // }
    // function products() {
    //     return $this->belongsToMany('App\Models\Product', 'reviews')->withPivot('id')->withPivot('review_rating')->withPivot('review_content')->withTimestamps();
    // }
    function likes() {
        return $this->hasMany('App\Models\Like');
    }

    function dislikes() {
        return $this->hasMany('App\Models\Dislike');
    }
}
