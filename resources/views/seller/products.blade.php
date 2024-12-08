@extends('layouts.app')

@section('content')
    <h1>My Products</h1>
    <a href="{{ route('seller.products.create') }}">Add New Product</a>
    <div class="products">
        @foreach($products as $product)
            <div class="product">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>Price: ${{ $product->price }}</p>
                <p>Stock: {{ $product->stock }}</p>
                <a href="{{ route('seller.products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('seller.products.delete', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
