<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecommendationController;
use App\Models\Product;
use App\Models\User;
use App\Models\Follow;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $user = User::find(1);
    // $prods = $user->products;
    // dd($prods);

    // $name = 'Apple';
    // $prods = $user->products()->whereRaw('name like ?', array("%$name%"))->get();
    // dd($prods);

    // $name = 'Apple';
    // $products = Product::whereHas('manufacturer', function($query) use ($name) {
    //     return $query->whereRaw('name like ?', array("%$name%"));
    // })->get();
    // dd($products);
});

Route::get('/', [ProductController::class, 'index']);

Route::resource('product', ProductController::class);

Route::resource('review', ReviewController::class);

Route::resource('image', ImageController::class);

Route::resource('user', UserController::class);

Route::get('liked/{id}', 'App\Http\Controllers\ReviewController@like');
Route::get('disliked/{id}', 'App\Http\Controllers\ReviewController@dislike');
Route::get('follow/{id}', 'App\Http\Controllers\UserController@follow');
Route::get('unfollow/{id}', 'App\Http\Controllers\UserController@unfollow');
Route::get('recommend/products', 'App\Http\Controllers\RecommendationController@recommendproducts');
Route::get('recommend/users', 'App\Http\Controllers\RecommendationController@recommendusers');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('documentation', function () {
    return view('products.documentation');
});

require __DIR__.'/auth.php';

// 1234