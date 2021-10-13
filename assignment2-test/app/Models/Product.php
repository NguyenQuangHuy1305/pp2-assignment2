<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price','description', 'manufacturer_id', 'product_url'];

    function manufacturer() {
        return $this->belongsTo('App\Models\Manufacturer');
    }

    function reviews() {
        return $this->belongsToMany('App\Models\User', 'reviews')
        ->withPivot('id')
        ->withPivot('review_rating')
        ->withPivot('review_content')
        ->withPivot('like_count')
        ->withPivot('dislike_count')
        ->withPivot('user_name')
        ->withTimestamps();
    }

    function images() {
        return $this->hasMany('App\Models\Image');
    }
}