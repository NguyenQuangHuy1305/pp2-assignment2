@extends('layouts.master2')

@section('title')
  Create review
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">Post a review</h1>
  <p> Here you can post a review for {{$product_name}} </p>
@endsection

@section('content')
  <form method="post" action="{{url("review")}}">
  {{csrf_field()}}

  @if (count($errors)>0)
  <div class="alert">
    @foreach ($errors->all() as $error)
      <p style="color: red;"> {{$error}}</li>
    @endforeach
  </div>
  @endif

  <p>
    <label>Review rating</label>
    <input type="text" name="review_rating" value="{{old('review_rating')}}">
  </p>

  <p>
    <label>Review content</label>
    <textarea type="text" name="review_content" placeholder="{{old('review_content')}}"></textarea>
  </p>
  
    <input type="submit" id="submit" value="Submit review!">
  </form>
@endsection