@extends('layouts.master2')

@section('title')
    Product recommendation
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">Product recommendation</h1>
  <p> Here you will find products that might interest you! </p>
@endsection

@section('content')
    <?php
        use App\Models\Manufacturer;
    ?>

    <table style:>
        <tr bgcolor="#9966ff">
            <th>Product</th>
            <th>Reason for recommendation</th>
        </tr>
        @foreach ($recommended_products_reason1 as $recommended_product_reason1)
            <tr>
                <td><a href = '{{ url("product/$recommended_product_reason1->id") }}'>{{$recommended_product_reason1->name}}</a></td>
                <td>Having highest average rating among all products</td>
            </tr>
        @endforeach

        @foreach ($recommended_products_reason2 as $recommended_product_reason2)
            <tr>
                <td><a href = '{{ url("product/$recommended_product_reason2->id") }}'>{{$recommended_product_reason2->name}}</a></td>
                <td>The people you followed liked these products</td>
            </tr>
        @endforeach

        @foreach ($recommended_products_reason3 as $recommended_product_reason3)
            <?php
                $manufacturer = Manufacturer::find($recommended_product_reason3->manufacturer_id);
            ?>

            <tr>
                <td><a href = '{{ url("product/$recommended_product_reason3->id") }}'>{{$recommended_product_reason3->name}}</a></td>
                <td>Because you liked products from {{$manufacturer->name}}</td>
            </tr>
        @endforeach
    </table>
@endsection