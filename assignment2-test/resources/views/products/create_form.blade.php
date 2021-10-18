@extends('layouts.master2')

@section('title')
  Product create
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">Create product</h1>
  <p> Here you can post a new product! </p>
@endsection

@section('content')
  <form method="post" action="{{url("product")}}">
    {{csrf_field()}}

    @if (count($errors)>0)
    <div class="alert">

        @foreach ($errors->all() as $error)
          <p style="color: red;"> {{$error}}</li>
        @endforeach

    </div>
    @endif
    
    <p>
      <label>Name</label>
      <input type="text" name="name" value="{{old('name')}}">
    </p>

    <p>
      <label>Preimum rate</label>
      <input type="text" name="price" value="{{old('price')}}"></input>
    </p>

    <p>
      <label>Description</label>
      <textarea type="text" name="description" placeholder="{{old('description')}}"></textarea>
    </p>

    <p><select name="manufacturer">
    @foreach ($manufacturers as $manufacturer)
      @if ($manufacturer->id == old('manufacturer'))
        <option value="{{$manufacturer->id}}" selected>{{$manufacturer->name}}</option>
      @else
        <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
      @endif
    @endforeach
    </select></p>
  
    <input type="submit" id="submit" value="Create">
  </form>
@endsection