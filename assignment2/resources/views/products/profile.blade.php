@extends('layouts.master2')

@section('title')
  User's profile
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">{{$user->name}}'s profile</h1>
  <p> Here you can find a list of reviews {{$user->name}} has posted! </p>
@endsection

@section('content')
  
  <table style:>
  <tr bgcolor="#9966ff">
    <th>Reviewer's name</th>
    <th>Reviewed product</th>
    <th>Reviewer's rating</th>
    <th>Review content</th>
    <th>Review created at</th>
    @auth
      <th>Like</th>
      <th>Dislike</th>
    @endauth
  </tr>
    @foreach ($reviews as $review)
      <?php
      // dd($review);
      $review_id = $review->pivot->id;
      $user_id = $review->pivot->user_id;
      if ($review->pivot->like_count > $review->pivot->dislike_count) { ?>
      <tr bgcolor="#66ff66">
      <?php } elseif ($review->pivot->like_count < $review->pivot->dislike_count) { ?>
      <tr bgcolor="#ff9966">
      <?php } ?>
      
        <td>
          {{$review->pivot->user_name}}

          <?php

          if (Auth::user()->id != $user_id) {
            $follow = DB::table('follows')->where('follower_user_id', Auth::user()->id)->where('followed_user_id', $user_id)->get();
            if ($follow->isEmpty()) { ?>
              <a href = '{{ url("follow/$user_id") }}'> Follow</a>
            <?php } elseif (count($follow) > 0) { ?>
              <a href = '{{ url("unfollow/$user_id") }}'> Unfollow</a>
            <?php }
          }?>

        </td>

        <td><a href = '{{ url("product/$review->id") }}'>{{$review->name}}</a></td>
        <td>{{$review->pivot->review_rating}}</td>
        <td>{{$review->pivot->review_content}}</td>
        <td>{{$review->pivot->created_at}}</td>

        @auth

          <td>
            <?php
              $like = DB::table('likes')->where('user_id', Auth::user()->id)->where('review_id', $review->pivot->id)->get();
              if ($like->isEmpty()) { ?>
                <a href = '{{ url("liked/$review_id") }}'><img src="{{asset('images/'.'like.png')}}" width="20"></a>
              <?php } elseif (count($like) > 0) { ?>
                <a href = '{{ url("liked/$review_id") }}'><img src="{{asset('images/'.'liked.png')}}" width="20"></a>
              <?php } ?>
                {{$review->pivot->like_count}}
          </td>

          <td>
            <?php
              $dislike = DB::table('dislikes')->where('user_id', Auth::user()->id)->where('review_id', $review->pivot->id)->get();
              if ($dislike->isEmpty()) { ?>
                <a href = '{{ url("disliked/$review_id") }}'><img src="{{asset('images/'.'dislike.png')}}" width="20"></a>
              <?php } elseif (count($dislike) > 0) { ?>
                <a href = '{{ url("disliked/$review_id") }}'><img src="{{asset('images/'.'disliked.png')}}" width="20"></a>
              <?php } ?>
                {{$review->pivot->dislike_count}}
          </td>

        @endauth
      </tr>
    @endforeach
  </table>
  
@endsection