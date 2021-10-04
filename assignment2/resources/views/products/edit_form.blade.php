@extends('layouts.master2')

@section('title')
  Product update
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">Update product</h1>
  <p> Here you can update the product: {{$product->name}}! </p>
@endsection

@section('content')
    <form method="post" action= '{{url("product/$product->id")}}'>
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
        <label>Name</label>
        <input type="text" name="name" value="{{$product->name}}"> <label>{{$errors->first('name')}}</label>
      </p>

      <p>
        <label>Price</label>
        <input type="text" name="price" value="{{$product->price}}"><label>{{$errors->first('price')}}</label>
      </p>

      <p>
        <label>Description</label>
        <textarea type="text" name="description" placeholder="{{$product->description}}"></textarea>{{$errors->first('description')}}</label>
      </p>

      <p><select name="manufacturer">
      @foreach ($manufacturers as $manufacturer)
        @if ($manufacturer->id == $product->manufacturer_id)
          <option value="{{$manufacturer->id}}" selected>{{$manufacturer->name}}</option>
        @else
          <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
        @endif
      @endforeach
      </select></p>

      <input type="submit" id="submit" value="Update">
    </form>
@endsection