<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = $user->followed; // get all the user that the current user is following

        return view('products.personal_profile')->with('user', $user)->with('users', $users);
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
        $user = User::find($id);
        $reviews = $user->reviews;
        dd($reviews);
        return view('products.profile')->with('user', $user)->with('reviews', $reviews);
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

    public function follow(Request $request, $id)
    {
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"
        $user = User::find($id);

        $follow = new Follow();
        $follow->follower_user_id = Auth::user()->id;
        $follow->followed_user_id = $id;
        $follow->followed_user_name = $user->name;
        $follow->save();

        return redirect()->back();    }

    public function unfollow(Request $request, $id)
    {
        $product_id = $request->session()->get('product_id'); //get the product_id from the "session"

        $follow = Follow::where('follower_user_id', Auth::user()->id)->where('followed_user_id', $id)->delete();

        return redirect()->back();    
    }
}
