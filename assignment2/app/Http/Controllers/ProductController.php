<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class ProductController extends Controller
{
    function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::paginate(4);
        // dd($products);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('products.create_form')->with('manufacturers', Manufacturer::all());
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
            'name' => 'required|max:255|unique:products',
            'price' => 'required|numeric|min:1',
            'description' => 'required|max:255',
            'manufacturer' => 'required|exists:manufacturers,id',
            'product_url' => 'nullable|url'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->manufacturer_id = $request->manufacturer;
        $product->product_url = url("product");
        $product->save();        
        $product->product_url = url("product").'/'.$product->id;
        $product->save();
        return redirect("product/$product->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(Request $request, $id)
    {
        $product = Product::find($id); // get the product
        $product_id = $product->id;

        $reviews = Review::where('product_id', '=', $product_id)->paginate(5);

        // $reviews = $product->reviews; // get a pivot table (reviews)
        // dd($reviews);

        $request->session()->put('product_id', $product->id); // save the current product_id to the session for use later

        $images = DB::table('images')->where('product_id', $id)->get(); // getting all the images where the image->product_id = current product's $id

        $error = [];

        return view('products.show')->with('product', $product)->with('reviews', $reviews)->with('images', $images)->with('error', $error);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == 'member') {
            dd('Member are not allowed to do this, how did you get here?');
        }
        else {
            $product = Product::find($id);
                return view('products.edit_form')->with('product', $product)->with('manufacturers', Manufacturer::all());
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
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|max:255',
            'manufacturer' => 'required|exists:manufacturers,id',
            'product_url' => 'url',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->manufacturer_id = $request->manufacturer;
        $product->product_url = '';
        $product->save();
        return redirect("product/$product->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 'member') {
            dd('Member are not allowed to do this, how did you get here?');
        }

        // maybe add elseif when member is a moderator
        else {
            $product = Product::find($id);

            // https://stackoverflow.com/questions/5890250/on-delete-cascade-in-sqlite3

            // get all the reviews of the product with $id
            $reviews = $product->reviews;

            // loop through all the reviews, with each loop delete the review where the review's product_id = $id
            foreach ($reviews as $review) {
                DB::table('reviews')->where('product_id', $id)->delete();
            }

            $product->delete();
            
            return redirect("product");
        }
    }
}
