@extends('layouts.userApp')

@section('title', 'Shopping Cart')

@section('content')

<div class="d-flex flex-row w-100 h-25 justify-content-center mt-2  p-2" >
  <div id="infoBar" class="container d-flex flex-row border bg-light w-50 p-0">
    
    <div  class="container d-flex flex-row align-items-center w-25 me-0 ">
      <a id="backButtonSearch" class="d-flex flex-row-reverse link-primary w-100 h-75 border-end border-primary fs-4 ms-2 align-items-center" href="{{ route('user.index') }}">
        <i id="backButtonIcon" class="bi bi-backspace-fill me-2" style="font-size: 2rem;"></i>
      </a>
    </div>
  
    <div class="container d-flex flex-row align-items-center w-75 ms-0">
      <h5 id="textSearch" class="d-flex flex-column align-items-center p-2 mt-1">Shopping Cart</h5>
    </div>

  </div>
</div>
@if($element)
  <div class="d-flex flex-column w-100 h-100 mt-3  align-items-center  ">
    <div class="d-flex flex-row w-50 h-50 justify-content-between bg-light p-1">
      <div class="d-flex justify-content-center w-50 h-100 border-end  border-bottom">Product</div>
      <div class="d-flex justify-content-center w-50 h-100 border-bottom">Quantity</div>
      <div class="d-flex justify-content-center w-25 h-100 border-start  border-bottom" >Total (Lei)</div>
    </div>
        @foreach ($element as $product)
        <div class="d-flex flex-row w-50 h-50 justify-content-between border-2 border-bottom bg-light p-1 shadow ">
          <div class="d-flex flex-row w-50 border-1 border-end border-secondary">
            <div class="d-flex flex-column w-75">
              <p class="d-flex w-100 ms-1 ">{{ $product['name'] }}</p>
              <p class="d-flex w-100 ms-1 ">{{ $product['price'] }} Lei</p>

            </div>
            <div class="d-flex flex-column w-25">
              <form class="d-flex w-100 h-100 " action="{{ route('user.removeFromCart', $product['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-link w-100 h-100" type="submit">
                  <i class="bi bi-trash" style="font-size: 1.2rem;"></i>
                </button>
              </form>

            </div>
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