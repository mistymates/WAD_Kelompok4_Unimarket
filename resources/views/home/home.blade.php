@extends('layouts.app')

@section('content')
    <h1>Welcome to UniMarket</h1>
    <div>
        <h2>Featured Products</h2>
        <div class="products">
            @foreach($products as $product)
                <div class="product">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>Price: ${{ $product->price }}</p>
                    <a href="{{ route('product.show', $product->id) }}">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
