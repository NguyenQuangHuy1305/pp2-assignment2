<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    function users() {
        return $this->belongsToMany('App\Models\User', 'follows')
        ->withPivot('followed_user_name')
        ->withTimestamps();
    }
}
