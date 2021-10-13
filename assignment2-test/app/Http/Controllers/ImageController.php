<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\Image;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ImageController extends Controller
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

        $this->validate($request, [
            'user_id' => 'exists:users,id',
            'product_id' => 'exists:products,id',
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);

        $newImageName = time().'-'.$request->image->getClientOriginalName();

        $test = $request->image->move(public_path('images'), $newImageName);

        $user_id = Auth::user()->id; // get the current user's id
        $user_name = Auth::user()->name; // get the current user's name
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        
        $image = new Image();
        $image->user_id = $user_id;
        $image->user_name = $user_name;
        $image->product_id = $product_id;
        $image->image_path = $newImageName;

        $image->save();
        return redirect("/product/$product_id");
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
}
