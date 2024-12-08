@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>
    @if($cartItems->count() > 0)
        <div class="cart">
            @foreach($cartItems as $cartItem)
                <div class="cart-item">
                    <h3>{{ $cartItem->product->name }}</h3>
                    <p>Price: ${{ $cartItem->product->price }}</p>
                    <p>Quantity: {{ $cartItem->quantity }}</p>
                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove from Cart</button>
                    </form>
                </div>
            @endforeach
            <div class="total">
                <h3>Total: ${{ $totalPrice }}</h3>
            </div>
            <a href="{{ route('checkout') }}">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty!</p>
    @endif
@endsection
