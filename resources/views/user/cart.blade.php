@extends('layouts.userApp')

@section('title', 'Shopping Cart')

@section('content')

@php
 use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\Storage;
@endphp



  <div class="shopping-cart">
    @if($element)
    <div class="shopping-cart-total">
      <a class="shopping-cart-total-checkout" href="{{ route('user.checkout') }}">Checkout</a>
    </div>
    @foreach ($element as $product )
      
   
    <div class="shopping-cart-product">

      <div class="shopping-cart-product-image">
        <a class="shopping-cart-product-image-link" href="{{ route('user.show', $product['id']) }}">
          @isset($product['image'])
            
          <img class="shopping-cart-product-image-img" src="{{ Storage::disk('s3')->url($product['image']) }}">
          @endisset
        </a>
      </div>

      <div class="shopping-cart-product-description">
        <div class="shopping-cart-product-description-row-1">

          <a href="{{  route('user.show', $product['id']) }}"><p class="shopping-cart-name">{{ $product['name'] }}</p></a>
          <p class="product-total-calc">{{ $product['price'] }} LEI x {{ $product['quantity'] }} = {{ $product['totalPrice'] }} Lei</p>
          <div class="shopping-cart-product-quantity">

            <form class="form-decrease" action="{{ route('user.decreaseQuantity', $product['id']) }}" method="POST">
              @csrf
              
              <input id="toDecrease" class="button-decrease" type="submit" value="-">
            </form>

            <p id="quantity" class="product-total-quantity">Quantity {{ $product['quantity'] }}</p>

            <form class="form-increase" action="{{ route('user.increaseQuantity', $product['id']) }}" method="POST">
              @csrf
          
              <input id="toIncrease" class="button-increase" type="submit" value="+">
            </form>
          </div>

        </div>

        <div class="shopping-cart-product-description-row-2">
          <form action="{{ route('user.removeFromCart', $product['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="button-delete" type="submit">
              <i class="fa-solid fa-circle-xmark"></i>
            </button>
          </form>
        </div>

      </div>

    </div>

    @endforeach

    @else 
    <div class="shopping-cart-empty">
      @if (Session::has('cart'))
      <p>{{ Session::get('cart') }}</p>
      @endif
    </div>
    @endif
  </div>


@endsection