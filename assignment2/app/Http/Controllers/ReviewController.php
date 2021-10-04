<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
    public function create(Request $request)
    {
        // if the person has already reviewed this product, then dd something like "you've already reviewed this product"
        $user_id = Auth::user()->id; // get the current user_id
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        $product = Product::find($product_id);

        $reviews = Review::all();
        foreach ($reviews as $review) {
            if ($user_id == $review->user_id && $product_id == $review->product_id) {

                // get the stuffs needed in order to return to the product's "show" page
                $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
                $product = Product::find($product_id); // get the product
                $reviews = Review::where('product_id', '=', $product_id)->paginate(5);
                $images = DB::table('images')->where('product_id', $product_id)->get(); // getting all the images where the image->product_id = current product's $id

                $error = ["You've already reviewed this product"];

                return view('products.show')
                ->with('product', $product)
                ->with('reviews', $reviews)
                ->with('images', $images)
                ->with('error', $error);
            }
        }

        // if the user has not revied this product --> proceed to redirect to the create form
        return view('products.review_form')->with('product_name', $product->name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'exists:users,id',
            'product_id' => 'exists:products,id',
            'review_rating' => 'required|numeric|between:1,5',
            'review_content' => 'required|min:5',
        ]);

        $user_id = Auth::user()->id; // get the current user_id
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        
        $review = new Review();
        $review->user_id = $user_id;
        $review->user_name = Auth::user()->name;
        $review->product_id = $product_id;
        $review->review_rating = $request->review_rating;
        $review->review_content = $request->review_content;
        $review->like_count = 0;
        $review->dislike_count = 0;
        $review->save();

        return redirect("/product/$product_id");
    }
    
    public function like(Request $request, $id)
    {
        $user_id = Auth::user()->id; // get the current user_id
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        $likes = DB::table('likes')->get();
        $dislikes = DB::table('dislikes')->get();

        // loop through all the likes in the like table, if the current user's id = the like's id AND the "clicked on" review's id = the like's review_id, then delete the like (aka un-like), then redirect to the previous product page
        // basically this part is the "un-like" feature
        foreach ($likes as $like) {
            if ($user_id == $like->user_id && $id == $like->review_id) {
                DB::table('likes')->where('user_id', $user_id)->where('review_id' , $id)->delete();

                // this part is for updating the like_count and dislike_count of a review after the count changed
                $review = Review::find($id);
                $review->like_count = DB::table('likes')->where('review_id', $review->id)->count();
                $review->dislike_count = DB::table('dislikes')->where('review_id', $review->id)->count();
                $review->save();

                return redirect()->back();
            }
        }

        // loop through all the dislikes in the dislikes table,
        // if the current user's id = the dislike's id AND the "clicked on" review's id = the dislike's review_id,
        // then delete the dislike (aka un-dislike),
        // then create a new like
        // then redirect to the previous product page
        // basically this part is the "un-dislike, then turn it into a like" feature
        foreach ($dislikes as $dislike) {
            if ($user_id == $dislike->user_id && $id == $dislike->review_id) {
                DB::table('dislikes')->where('user_id', $user_id)->where('review_id', $id)->delete();
                $like = new Like();
                $like->user_id = $user_id;
                $like->review_id = $id;
                $like->save();

                // this part is for updating the like_count and dislike_count of a review after the count changed
                $review = Review::find($id);
                $review->like_count = DB::table('likes')->where('review_id', $review->id)->count();
                $review->dislike_count = DB::table('dislikes')->where('review_id', $review->id)->count();
                $review->save();

                return redirect()->back();
            }
        }

        // if there're nothing special (no un-like, no "already disliked"), then this is the part to create a new like when the like button is pressed
        $like = new Like();
        $like->user_id = $user_id;
        $like->review_id = $id;
        $like->save();

        // this part is for updating the like_count and dislike_count of a review after the count changed
        $review = Review::find($id);
        $review->like_count = DB::table('likes')->where('review_id', $review->id)->count();
        $review->dislike_count = DB::table('dislikes')->where('review_id', $review->id)->count();
        $review->save();

        return redirect()->back();
    }

    public function dislike(Request $request, $id)
    {
        $user_id = Auth::user()->id; // get the current user_id
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        $dislikes = DB::table('dislikes')->get();
        $likes = DB::table('likes')->get();
        
        // loop through all the dislikes in the dislikes table, if the current user's id = the dislikes's id AND the "clicked on" review's id = the dislikes's review_id, then delete the dislikes (aka un-dislikes), then redirect to the previous product page
        // basically this part is the "un-dislikes" feature
        foreach ($dislikes as $dislike) {
            if ($user_id == $dislike->user_id && $id == $dislike->review_id) {
                DB::table('dislikes')->where('user_id', $user_id)->where('review_id', $id)->delete();

                // this part is for updating the like_count and dislike_count of a review after the count changed
                $review = Review::find($id);
                $review->like_count = DB::table('likes')->where('review_id', $review->id)->count();
                $review->dislike_count = DB::table('dislikes')->where('review_id', $review->id)->count();
                $review->save();

                return redirect()->back();
            }
        }

        // loop through all the likes in the likes table,
        // if the current user's id = the like's id AND the "clicked on" review's id = the like's review_id,
        // then delete the like (aka un-like),
        // then create a new dislike
        // then redirect to the previous product page
        // basically this part is the "un-like, then turn it into a dislike" feature
        foreach ($likes as $like) {
            if ($user_id == $like->user_id && $id == $like->review_id) {
                DB::table('likes')->where('user_id', $user_id)->where('review_id', $id)->delete();
                $dislike = new Dislike();
                $dislike->user_id = $user_id;
                $dislike->review_id = $id;
                $dislike->save();

                // this part is for updating the like_count and dislike_count of a review after the count changed
                $review = Review::find($id);
                $review->like_count = DB::table('likes')->where('review_id', $review->id)->count();
                $review->dislike_count = DB::table('dislikes')->where('review_id', $review->id)->count();
                $review->save();

                return redirect()->back();
            }
        }

        $dislike = new Dislike();
        $dislike->user_id = $user_id;
        $dislike->review_id = $id;
        $dislike->save();

        // this part is for updating the like_count and dislike_count of a review after the count changed
        $review = Review::find($id);
        $review->like_count = DB::table('likes')->where('review_id', $review->id)->count();
        $review->dislike_count = DB::table('dislikes')->where('review_id', $review->id)->count();
        $review->save();
        
        return redirect()->back();
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
        $review = Review::find($id); // This $id comes from show.blade.php like this "review/$review_id/edit"
        $user_id = Auth::user()->id; // get the current user_id
        $product = Product::find($review->product_id);

        if ($user_id == $review->user_id || Auth::user()->role == 'moderator') {
            return view('products.review_edit_form')->with('review', $review)->with('product', $product);
        }
        else {
            dd("You can't edit someone else's review, how did you get here?");
        }
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
        $this->validate($request, [
            'user_id' => 'exists:users,id',
            'user_name' => 'exists:users,name',
            'product_id' => 'exists:products,id',
            'review_rating' => 'required|numeric|between:1,5',
            'review_content' => 'required|max:255',
        ]);

        $review = Review::find($id);
        $review->review_rating = $request->review_rating;
        $review->review_content = $request->review_content;
        $review->save();
        return redirect("product/$review->product_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $review = Review::find($id); // This $id comes from show.blade.php like this "review/$review_id/edit"
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        $user_id = Auth::user()->id; // get the current user_id

        if ($user_id == $review->user_id || Auth::user()->role == 'moderator') {
            $review->delete();
            return redirect("product/$product_id");
        }
        else {
            dd("You can't delete someone else's review, how did you get here?");
        }
    }
}