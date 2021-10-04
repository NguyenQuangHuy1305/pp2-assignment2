@extends('layouts.master2')

@section('title')
Update review
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">Update a review</h1>
  <p> You can update your review for {{$product->name}} here! </p>
@endsection

@section('content')

    <form method="post" action= '{{url("review/$review->id")}}'>
    {{csrf_field()}}
    {{method_field('PUT')}}

    @if (count($errors)>0)
    <div class="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <p>
      <label>Review rating</label>
      <input type="text" name="review_rating" value="{{$review->review_rating}}">
    </p>

    <p>
      <label>Review content</label>
      <textarea type="text" name="review_content" placeholder="{{$review->review_content}}"></textarea>
    </p>

    <input type="submit" id="submit" value="Update">
  </form>
@endsection