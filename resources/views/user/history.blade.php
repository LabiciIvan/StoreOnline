@extends('layouts.userApp')

@section('title', 'Shopping Cart')

@section('content')


<div class="d-flex flex-row w-100 h-100 justify-content-center p-2 mt-4">

  <div class="d-flex flex-column w-25 h-100 m-2 p-2 bg-light rounded-2 shadow">
    <a class="btn btn-primary w-25 m-2" href="{{ route('user.profile') }}">Profile</a>
    <a class="btn btn-primary w-25 m-2" href="">History</a>
  </div>

  <div class="d-flex flex-column w-50 h-100 m-2 bg-light rounded-2 align-items-center shadow">
    <h5 class="d-flex  border-bottom w-50 justify-content-center p-2">History of your purchases</h5>

    <div class="d-flex flex-column w-100 h-100 m-2  p-2 rounded-2 mt-4">
      
      {{-- {{ $order->totalPrice}} --}}
      <div class="d-flex flex-row justify-content-between mt-2 mb-2 border-bottom border-dark p-2">
        <div class="d-flex w-25 border-end border-dark justify-content-center">Date</div>
        <div class="d-flex w-50 border-end border-dark justify-content-center">Order</div>
        <div class="d-flex w-25 justify-content-center">Total</div>
      </div>

        @if ($orders->order()->exists())
            @foreach ($orders->order as $order )
            <div class="d-flex flex-row justify-content-between border border-dark p-2 mt-2">
              <div class="d-flex w-25 border-end border-dark justify-content-center">{{ $order->created_at }}</div>
              <div class="d-flex w-50 border-end border-dark justify-content-center">{{ $order->order }}</div>
              <div class="d-flex w-25 justify-content-center">{{ $order->totalPrice }}</div>
            </div>
            @endforeach 
          @else
          
          <div class="d-flex justify-content-center">No previous purchases</div>
            
        @endif
          

    </div>

  </div>
</div>

@endsection