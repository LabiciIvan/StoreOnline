@extends('layouts.userApp')

@section('title', 'Store Online checkOut')

@section('content')
  <div class="d-flex flex-column w-100 h-100">
    <div class="d-flex flex-row w-100 h-10 justify-content-between m-2 bg-light shadow p-2">
      <a class="d-flex flex-row w-25 border-2 border-end justify-content-center btn btn-link" href="{{ route('user.viewCart') }}">Back to Cart</a>

      <div class="d-flex w-75 flex-row ms-4 align-items-center">
        <h4>CheckOut</h4>
      </div>
    </div>

    <div class="d-flex flex-column w-100 align-items-center m-4">
      <div class="card w-50">
        <div class="card-header d-flex justify-content-center">
          Your Bill
        </div>
        <ul class="list-group list-group-flush">
          <li class="d-flex flex-row justify-content-center list-group-item">
            <div class="d-flex w-50">Items</div>
            <div class="d-flex w-25">Quantity</div>
            <div class="d-flex w-25">Price (Lei)</div>
          </li>
        </ul>
        <ul class="list-group list-group-flush">
          @foreach ($products as $product )
            <li class="d-flex flex-row justify-content-between list-group-item">
              <div class="d-flex w-50 ">
                {{ $product['name'] }}
              </div>
              <div class="d-flex w-25">
                {{ $product['quantity'] }}
              </div>
              <div class="d-flex w-25">
                {{ $product['totalPrice'] }}
              </div>
            </li>
          @endforeach
        </ul>
      </div>

    </div>

    <div class="d-flex flex-column w-100 h-100 align-items-center">
      <div class="d-flex flex-column align-items-center w-25 bg-white rounded-1">
        <form class="d-flex flex-column w-75 h-100 align-items-center" action="{{ route('user.placeOrder') }}" method="POST">
          @csrf

          <label for="name">Full Name</label>
          <input type="text" name="name" id="name"  class="form-control" value="{{ old('name') }}">

          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone"  class="form-control" value="{{ old('phone') }}">

          <label for="address">Address</label>
          <textarea name="address" id="address" class="form-control" value="{{ old('address') }}"></textarea>
        
          <input type="hidden" value="{{ $productsOrdered }}" class="form-control" name="order">

          <input type="hidden" value="{{ $totalPrice}}" class="form-control" name="totalPrice">

          <input class="btn btn-warning m-3" type="submit" value="Place Order">
          @if($errors->any())
            @foreach ($errors->all() as $error )
              <h6>{{ $error }}</h6>
            @endforeach
          
          @endif
        </form>
      </div>
    </div>
  </div>  
@endsection