@extends('layouts.userApp')

@section('title', 'Shopping Cart')

@section('content')
@if($element)
  <div class="d-flex flex-column w-100 h-100 mt-3  align-items-center  ">
    <div class="d-flex flex-row w-50 h-50 justify-content-between bg-light p-1">
      <div class="d-flex justify-content-center w-50 h-100 border-end  border-bottom">Product</div>
      <div class="d-flex justify-content-center w-50 h-100 border-bottom">Quantity</div>
      <div class="d-flex justify-content-center w-25 h-100 border-start  border-bottom" >Total (Lei)</div>
    </div>
        @foreach ($element as $product)
        <div class="d-flex flex-row w-50 h-50 justify-content-between border-2 border-bottom bg-light p-1 shadow ">
          <div class="d-flex flex-column w-50 border-1 border-end border-secondary">
            <div class="d-flex">
              {{ $product['name'] }}
            </div>
            <div>
              {{ $product['price'] }} Lei
            </div>
            <form action="{{ route('user.removeFromCart', $product['id']) }}" method="POST">
              @csrf
              @method('DELETE')
              <input class="btn btn-link" type="submit" value="Remove">
            </form>
          </div>

          <div class="d-flex flex-column w-50 align-items-center justify-content-center">
            <div class="d-flex w-100 flex-row justify-content-center align-items-center">
              <form action="{{ route('user.decreaseQuantity', $product['id']) }}" method="POST">
                @csrf
                <input class="btn btn-primary m-1" type="submit" value="-">
              </form>
              <div class="d-flex border  justify-content-center bg-white" style="width:10%;">
                {{ $product['quantity'] }}
              </div>
              <form action="{{ route('user.increaseQuantity', $product['id']) }}" method="POST">
                @csrf
                <input class="btn btn-primary m-1" type="submit" value="+">
              </form>
            </div>
          </div>

          <div class="d-flex flex-column w-25 border-secondary border-1 border-start align-items-center justify-content-center">
            {{ $product['totalPrice'] }}
          </div>
        </div>
        @endforeach
        <div class="d-flex flex-row w-50 h-50 justify-content-center bg-light p-1 shadow">
          <div class="d-flex w-100 border-1 border-end border-secondary">
            <div class=" w-100" action="">
              <a class="btn btn-warning w-100" href="{{ route('user.checkout') }}">Proceed to checkout</a>
            </div>
          </div>
          <div class="d-flex w-25 justify-content-center align-items-center">
            {{ $total }} Lei
          </div>
        </div>
        @else
        @if(Session::has('status'))
        <div class="d-flex w-100 h-100 justify-content-center mt-4 ">
          <h4 class="alert alert-success">{{ Session::get('status') }}</h4>
        </div>
        @else
        <div class="d-flex w-100 h-100 justify-content-center mt-4">
          <h4 class="alert alert-secondary">Empty Cart</h4>
        </div>
        @endif
      @endif
  </div>
@endsection