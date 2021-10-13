<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Follow;
use App\Models\User;
use App\Models\Review;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function recommendproducts(Request $request)
    {
        $user = Auth::user();

        // reason1 - get the highest average rating product
        $recommended_products_reason1 = collect();
        $products = Product::all();
        $max_rating = 0;
        $highest_average_rating_product = Product::find(1);
        foreach ($products as $product) {
            $total_rating = 0;
            $average_rating = 0;
            $reviews = $product->reviews; // get all the reviews of the product
            $reviews_count = count($reviews);
            if ($reviews_count != 0) {
                foreach ($reviews as $review) {
                    $total_rating += $review->pivot->review_rating;
                }
                $average_rating = $total_rating / $reviews_count;
                if ($average_rating > $max_rating) {
                    $max_rating = $average_rating;
                    $highest_average_rating_product = $product;
                }
            }
        }
        $recommended_products_reason1->push($highest_average_rating_product);

        // reason2 - get the products that the people the current user followed liked (rating >=4)
        $recommended_products_reason2 = collect();
        
        $follows = Follow::where('follower_user_id', Auth::user()->id)->get();
        foreach ($follows as $follow) {
            $user = User::find($follow->followed_user_id);
            $reviews = $user->reviews; // get all the reviews made by the followed user
            foreach ($reviews as $review) {
                $product = Product::find($review->pivot->product_id);
                if ($review->pivot->review_rating < 4 || $recommended_products_reason2->contains($product)) {
                } else {
                    $recommended_products_reason2->push($product);
                }
            }
        }

        // reason3 - get all the product from the same manufacturer with the products the current user has already liked (review >4)
        $recommended_products_reason3 = collect();
        $user = Auth::user();
        $reviews = $user->reviews; // get all the reviews made by the current user
        foreach ($reviews as $review) {
            if ($review->pivot->review_rating > 3) {
                $product_reviewd = Product::find($review->pivot->product_id); // get the product which was reviewd in each review
                $manufacturer = Manufacturer::find($product_reviewd->manufacturer_id); // get the manufacturer of the above product
                $products = $manufacturer->products; // get all the products that was manufactured by the above manufacturer
                foreach ($products as $product) {
                    if ($recommended_products_reason3->contains($product)) {
                    } else {
                        $recommended_products_reason3->push($product);
                    }
                }
            }
        }

        return view('products.product_recommendation')
        ->with('user', $user)
        ->with('recommended_products_reason1', $recommended_products_reason1)
        ->with('recommended_products_reason2', $recommended_products_reason2)
        ->with('recommended_products_reason3', $recommended_products_reason3);
    }
    
    public function recommendusers()
    {
        $current_user = Auth::user();
        $recommended_users_reason1 = collect();

        // reason1 - get the user with highest count of like
        $recommended_products_reason1 = collect();
        $users = User::all(); // get all the user
        $like_max = 0;

        foreach ($users as $user) {
            $reviews = $user->reviews;                                              // get all the reviews belong to this user
            $like_sum = 0;
            foreach ($reviews as $review) {
                $like_sum += $review->pivot->like_count;     
            }
            if ($like_sum > $like_max && $user->id != $current_user->id) {          // if the user (being checked) has $like_sum > $like_max AND is not the current user
                $like_max = $like_sum;                                              // then the $like_sum will be the new $like_max
                $recommended_users_reason1 = collect();
                $recommended_users_reason1->push($user);                            // and the user (being checked) will be the new recommended user
            } elseif ($like_sum == $like_max && $user->id != $current_user->id && $like_sum != 0) {   // if the the user (being check) has $like_sum = $like_max AND is not the current user
                $recommended_users_reason1->push($user);                            // then append the user (being checked) into the users_recommended collection
            }
        }

        // reason2 - get the users who writes the most amount of reviews
        $recommended_users_reason2 = collect();
        $users = User::all(); // get all the user
        $review_count_max = 0;
        $review_count = 0;

        foreach ($users as $user) {
            $reviews = $user->reviews; // get all the reviews belong to this user
            $review_count = $reviews->count();
            if ($review_count > $review_count_max && $user->id != $current_user->id){
                $review_count_max = $review_count;
                $recommended_users_reason2 = collect();
                $recommended_users_reason2->push($user);
            } elseif ($review_count == $review_count_max && $user->id != $current_user->id && $review_count != 0) {
                $recommended_users_reason2->push($user);
            }
        }

        // reason3 - get the users who has the most followers
        $recommended_users_reason3 = collect();
        $users = User::all(); // get all the user
        $follower_count_max = 0;
        $follower_count = 0;

        foreach ($users as $user) {
            $followers = $user->follower; // get all the followers of the user (being checked)
            $follower_count = count($followers);
            if ($follower_count > $follower_count_max && $user->id != $current_user->id){
                $follower_count_max = $follower_count;
                $recommended_users_reason3 = collect();
                $recommended_users_reason3->push($user);
            } elseif ($follower_count == $follower_count_max && $user->id != $current_user->id && $follower_count != 0) {
                $recommended_users_reason3->push($user);
            }
        }

        $user = Auth::user();
        
        return view('products.user_recommendation')
        ->with('user', $user)
        ->with('recommended_users_reason1', $recommended_users_reason1)
        ->with('recommended_users_reason2', $recommended_users_reason2)
        ->with('recommended_users_reason3', $recommended_users_reason3);
    }
}
