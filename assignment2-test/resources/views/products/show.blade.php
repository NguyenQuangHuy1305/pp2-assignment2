@extends('layouts.master2')

@section('title')
  Product detail
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">{{$product->name}}</h1>
  <p>Price: {{$product->price}}</p>
  <p>Manufacturer: {{$product->manufacturer->name}}</p>
  <p>Description: {{$product->description}}</p>
  
  <!-- show edit button if the user is logged in and is a moderator -->
    <?php if (Auth::check() && Auth::user()->role == 'moderator') { ?>
    
    <p><a style="min-width: 200px" class="btn btn-outline-secondary" href = '{{ url("product/$product->id/edit") }}'>Edit</a></p>
  <?php } ?>

  <!-- show delete button if the user is logged in and is a moderator -->
  <?php if (Auth::check() && Auth::user()->role == 'moderator') { ?>
    <p>
      <form id="deleteitem" method="POST" action = '{{url("product/$product->id")}}'>
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <input class="btn btn-secondary" type="submit" id="submit1" value="Delete">
      </form>
    </p>
  <?php } ?>

@endsection

@section('content')

  <?php
    use App\Models\Follow;
    use App\Models\Like; 
    use App\Models\Dislike; 
  ?>

  @if (count($error)>0)
    <p style="color:red;">{{$error[0]}}</p>
  @endif
  
  @foreach ($images as $image)
    <img src="{{asset('images/'.$image->image_path)}}" height="300">
    <p><i>image uploaded by {{$image->user_name}}</i></p>
  @endforeach

  @if (count($reviews) > 0)
    <!-- show reviews table here -->
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
      <!-- loop through all reviews, each review is a row in the table -->
      @foreach ($reviews as $review)

        <?php
          if ($review->like_count > $review->dislike_count) { ?>
          <tr bgcolor="#66ff66">
          <?php } elseif ($review->like_count < $review->dislike_count) { ?>
          <tr bgcolor="#ff9966">
        <?php } ?>
        
          <td>
            {{$review->user_name}}
            @auth
            <?php
              if (Auth::user()->id != $review->user_id) {
                $follow = Follow::where('follower_user_id', Auth::user()->id)->where('followed_user_id', $review->user_id)->get();
                if ($follow->isEmpty()) { ?>
                  <a href = '{{ url("follow/$review->user_id") }}'> Follow</a>
                <?php } elseif (count($follow) > 0) { ?>
                  <a href = '{{ url("unfollow/$review->user_id") }}'> Unfollow</a>
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
                $like = Like::where('user_id', Auth::user()->id)->where('review_id', $review->id)->get();
                if ($like->isEmpty()) { ?>
                  <a href = '{{ url("liked/$review->id") }}'><img src="{{asset('images/'.'like.png')}}" width="20"></a>
                <?php } elseif (count($like) > 0) { ?>
                  <a href = '{{ url("liked/$review->id") }}'><img src="{{asset('images/'.'liked.png')}}" width="20"></a>
                <?php } ?>
                  {{$review->like_count}}
            </td>

            <td>
              <?php
                $dislike = Dislike::where('user_id', Auth::user()->id)->where('review_id', $review->id)->get();
                if ($dislike->isEmpty()) { ?>
                  <a href = '{{ url("disliked/$review->id") }}'><img src="{{asset('images/'.'dislike.png')}}" width="20"></a>
                <?php } elseif (count($dislike) > 0) { ?>
                  <a href = '{{ url("disliked/$review->id") }}'><img src="{{asset('images/'.'disliked.png')}}" width="20"></a>
                <?php } ?>
                  {{$review->dislike_count}}
            </td>

            <?php if (Auth::user()->id == $review->user_id || Auth::user()->role == 'moderator') { ?>

            <td><a href = '{{ url("review/$review->id/edit") }}'>Update</a></td> 
            
            <td>          
              <form id="deletereview" method="POST" action = '{{url("review/$review->id")}}'>
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
  @else
  <p style="color: red"> This product doesn't have any review yet, you can write your review for this product by clicking this button below </p>
  @endif
  
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      {{$reviews->links()}}
    </ul>
  </nav>

  @auth
  <a style="min-width: 755px" class="btn btn-outline-secondary" href='{{ url("review/create") }}'>Review this product</a>
  <br>

  <form style="margin-top: 20px;" method="POST" action = '{{url("image")}}' enctype = 'multipart/form-data'>
    {{csrf_field()}}
    <input type = 'file' name='image'>
    <input type="submit" value="Upload">
  </form>
  @endauth

@endsection