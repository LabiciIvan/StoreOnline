@extends('layouts.userApp')

@section('title', 'Store Online checkOut')

@section('content')
  <div class="d-flex flex-column w-100 h-100">

    <div class="d-flex flex-row w-100 h-25 justify-content-center mt-2  p-2" >
      <div id="infoBar" class="container d-flex flex-row border bg-light w-50 p-0">
        
        <div  class="container d-flex flex-row align-items-center w-25 me-0 ">
          <a id="backButtonSearch" class="d-flex flex-row-reverse link-primary w-100 h-75 border-end border-primary fs-4 ms-2 align-items-center" href="{{ route('user.viewCart') }}">
            <i id="backButtonIcon" class="bi bi-backspace-fill me-2" style="font-size: 2rem;"></i>
          </a>
        </div>
      
        <div class="container d-flex flex-row align-items-center w-75 ms-0">
          <h5 id="textSearch" class="d-flex flex-column align-items-center p-2 mt-1">CheckOut</h5>
        </div>
  
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

    {{-- <div class="d-flex flex-column w-100 h-100 align-items-center mt-4 mb-4">
      <div class="d-flex flex-column w-25 h-100 align-items-center border bg-light rounded-4">

      </div>
    </div> --}}

    <div class="d-flex flex-column w-100 h-100 align-items-center">
      <div class="d-flex flex-column align-items-center w-25 bg-white rounded-1 border">
        <form class="d-flex flex-column w-75 h-100 align-items-center"  action="{{ route('user.placeOrder') }}" method="POST">
          @csrf
          <label  for="payment">Choose Payment</label>

          <select class="form-select {{ $errors->has('payment') ? ' is-invalid' : '' }}" name="payment" id="payment">
            <option disabled selected value></option>
            <option value="CASH">CASH</option>
            <option value="CARD">CARD</option>
          </select>
          @if($errors->has('payment'))
          <span class="invalid-feedback">
            <strong>
              {{ $errors->first('payment') }}
            </strong>
          </span>
          @endif

          @guest
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name"  class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">

          @else
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name"  class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ Auth::user()->name }}">

          @endguest

          @if($errors->has('name'))
            <span class="invalid-feedback">
              <strong>
                {{ $errors->first('name') }}
              </strong>
            </span>
          @endif

                    
          @guest
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone"  class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}">
          @else
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone"  class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"  value="{{ Auth::user()->profile->phone }}">
          @endguest
          {{-- {{ Auth::user()->profile->phone }} --}}
          @if($errors->has('phone'))
          <span class="invalid-feedback">
            <strong>
              {{ $errors->first('phone') }}
            </strong>
          </span>
        @endif


        @guest
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}"></textarea>
        @else
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" >{{ Auth::user()->profile->country }}</textarea>
        @endguest
              @if($errors->has('address'))
            <span class="invalid-feedback">
              <strong>
                {{ $errors->first('address') }}
              </strong>
            </span>
          @endif 

          <input type="hidden" value="{{ $productsOrdered }}" class="form-control" name="order">

          <input type="hidden" value="{{ $totalPrice}}" class="form-control" name="totalPrice">

          <input class="btn btn-warning m-3 border text-white fw-bold" type="submit" value="Place Order">
          {{-- @if($errors->any())
            @foreach ($errors->all() as $error )
              <h6>{{ $error }}</h6>
            @endforeach
          
          @endif --}}
        </form>
      </div>
    </div>
  </div>  
@endsection