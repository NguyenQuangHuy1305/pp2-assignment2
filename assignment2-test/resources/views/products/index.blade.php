@extends('layouts.master2')

@section('title')
  Products
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">BSH online insurnace system</h1>
@endsection

@section('content')
  <h1 style="color:black; text-align:center">Product list</h1>
  @if ($products)

    @foreach ($products as $product)
      <a style="min-width: 500px" class="btn btn-outline-secondary" href="product/{{$product->id}}">{{$product->name}}</a></p>
    @endforeach

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        {{$products->links()}}
      </ul>
    </nav>

    
  @else
    No item found
  @endif
@endsection