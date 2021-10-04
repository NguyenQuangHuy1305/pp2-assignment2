@extends('layouts.master2')

@section('title')
  Product detail
@endsection

@section('content')
  <h1>{{$product->name}}</h1>
  
  @foreach ($images as $image)
    <img src="{{asset('images/'.$image->image_path)}}" height="300">
    <p><i>image uploaded by {{$image->user_name}}</i></p>
  @endforeach

  <p>Price: {{$product->price}}</p>
  <p>Description: {{$product->description}}</p>
  <p>Manufacturer: {{$product->manufacturer->name}}</p>

  <!-- show edit button if the user is logged in and is a moderator -->
  <?php if (Auth::check() && Auth::user()->role == 'moderator') { ?>
  
    <p><a href = '{{ url("product/$product->id/edit") }}'>Edit</a></p>

  <?php } ?>

  <!-- show delete button if the user is logged in and is a moderator -->
  <?php if (Auth::check() && Auth::user()->role == 'moderator') { ?>
    <p>
      <form method="POST" action = '{{url("product/$product->id")}}'>
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <input type="submit" value="Delete">
      </form>
    </p>
  <?php } ?>

  <!-- show reviews here -->
  <table style:>
  <tr bgcolor="#9966ff">
    <th>Reviewer's name</th>
    <th>Reviewer's rating</th>
    <th>Review content</th>
    <th>Review created at</th>
    @auth
      <th>Like</th>
      <th>Dislike</th>
      <th>Update</th>
      <th>Delete</th>
    @endauth
  </tr>
      @foreach ($reviews as $review)
        <?php
        // dd($review);
        $review_id = $review->id;
        $user_id = $review->user_id;
        if ($review->like_count > $review->dislike_count) { ?>
        <tr bgcolor="#66ff66">
        <?php } elseif ($review->like_count < $review->dislike_count) { ?>
        <tr bgcolor="#ff9966">
        <?php } ?>
        
          <td>
            {{$review->user_name}}
            @auth
            <?php
              if (Auth::user()->id != $user_id) {
                $follow = DB::table('follows')->where('follower_user_id', Auth::user()->id)->where('followed_user_id', $user_id)->get();
                if ($follow->isEmpty()) { ?>
                  <a href = '{{ url("follow/$user_id") }}'> Follow</a>
                <?php } elseif (count($follow) > 0) { ?>
                  <a href = '{{ url("unfollow/$user_id") }}'> Unfollow</a>
                <?php }
              }?>
            @endauth
          </td>

          <td>{{$review->review_rating}}</td>
          <td>{{$review->review_content}}</td>
          <td>{{$review->created_at}}</td>

          @auth

            <td>
              <?php
                $like = DB::table('likes')->where('user_id', Auth::user()->id)->where('review_id', $review->id)->get();
                if ($like->isEmpty()) { ?>
                  <a href = '{{ url("liked/$review_id") }}'><img src="{{asset('images/'.'like.png')}}" width="20"></a>
                <?php } elseif (count($like) > 0) { ?>
                  <a href = '{{ url("liked/$review_id") }}'><img src="{{asset('images/'.'liked.png')}}" width="20"></a>
                <?php } ?>
                  {{$review->like_count}}
            </td>

            <td>
              <?php
                $dislike = DB::table('dislikes')->where('user_id', Auth::user()->id)->where('review_id', $review->id)->get();
                if ($dislike->isEmpty()) { ?>
                  <a href = '{{ url("disliked/$review_id") }}'><img src="{{asset('images/'.'dislike.png')}}" width="20"></a>
                <?php } elseif (count($dislike) > 0) { ?>
                  <a href = '{{ url("disliked/$review_id") }}'><img src="{{asset('images/'.'disliked.png')}}" width="20"></a>
                <?php } ?>
                  {{$review->dislike_count}}
            </td>

            <?php if (Auth::user()->id == $review->user_id || Auth::user()->role == 'moderator') { ?>

            <td><a href = '{{ url("review/$review_id/edit") }}'>Update</a></td> 
            
            <td>          
              <form method="POST" action = '{{url("review/$review_id")}}'>
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <input type="submit" value="Delete">
              </form>
            </td>
            
            <?php } ?>

          @endauth
        </tr>
      @endforeach
  </table>

  @auth
  <p><a href = '{{ url("review/create") }}'>Review this product</a></p>

  <form method="POST" action = '{{url("image")}}' enctype = 'multipart/form-data'>
    {{csrf_field()}}
    <input type = 'file' name='image'>
    <input type="submit" value="Upload">
  </form>

  @endauth

@endsection