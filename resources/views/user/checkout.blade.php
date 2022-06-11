@extends('layouts.userApp')

@section('title', 'Store Online checkOut')

@section('content')
<?php 
 use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Facades\Auth;
?>
    


  <div class="checkout-section">

    <div class="checkout-section-left">
      @foreach ($products as $product )
      <div class="checkout-section-left-products">
       <p> {{ $product['name'] }}</p>
       <p>{{ $product['quantity'] }} </p>
       <p>x </p>
       <p>{{ $product['price'] }}</p>
       <p>{{ $product['totalPrice'] }} Lei</p>
      </div>
      @endforeach
    </div>

    <div class="checkout-section-right">

      <div class="checkout-section-right-payment">

        <form class="checkout-form"  action="{{ route('user.placeOrder') }}" method="POST">
          @csrf
          <label  for="payment">Choose Payment</label>

          <select class=" {{ $errors->has('payment') ? ' error-border' : '' }}" name="payment" id="payment">
            <option disabled selected value></option>
            <option value="CASH">CASH</option>
            <option value="CARD">CARD</option>
          </select>
          @if($errors->has('payment'))
          <span class="">
            <strong class="error-field">
              {{ $errors->first('payment') }}
            </strong>
          </span>
          @endif

          @guest
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name"  class=" {{ $errors->has('name') ? ' error-border' : '' }}" value="{{ old('name') }}">

          @else
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name"  class=" {{ $errors->has('name') ? ' error-border' : '' }}" value="{{ Auth::user()->name }}">

          @endguest

          @if($errors->has('name'))
            <span class="">
              <strong class="error-field">
                {{ $errors->first('name') }}
              </strong>
            </span>
          @endif

                    
          @guest
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone"  class=" {{ $errors->has('phone') ? ' error-border' : '' }}" value="{{ old('phone') }}">
          @else
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone"  class=" {{ $errors->has('phone') ? ' error-border' : '' }}"  value="{{ Auth::user()->profile->phone }}">
          @endguest
          {{-- {{ Auth::user()->profile->phone }} --}}
          @if($errors->has('phone'))
          <span class="">
            <strong class="error-field">
              {{ $errors->first('phone') }}
            </strong>
          </span>
        @endif


        @guest
        <label for="address">Address</label>
        <textarea name="address" id="address" class=" {{ $errors->has('address') ? ' error-border' : '' }}" value="{{ old('address') }}"></textarea>
        @else
        <label for="address">Address</label>
        <textarea name="address" id="address" class="{{ $errors->has('address') ? ' error-border' : '' }}" >{{ Auth::user()->profile->country }}</textarea>
        @endguest
              @if($errors->has('address'))
            <span class="">
              <strong class="error-field">
                {{ $errors->first('address') }}
              </strong>
            </span>
          @endif 

          <input type="hidden" value="{{ $productsOrdered }}" class="" name="order">

          <input type="hidden" value="{{ $totalPrice}}" class="" name="totalPrice">

          <div class="group-icon-button">
            <i class="fa-solid fa-angles-right"></i>
            <input class="place-order-button" type="submit" value="Place Order">
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection