@extends('layouts.app')

@section('title', 'Admin Order')

@section('content')
  <div class="d-flex flex-column w-100 h-100  align-items-center text-center mt-4 p-1">
    <h5 class="bg-warning">Placed Orders</h5>

    <div class="d-flex flex-row w-75 h-100 justify-content-center border border-primary p-1">
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Date</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Name</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Phone</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Address</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:23%"><h5 class="me-1 w-100">Order</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">totalPrice</h5></div>
      <div class="d-flex  justify-content-center ms-1 p-1" style="width:7%"><h5 class="ms-1 w-100">Confirm</h5></div>
    </div>
    @if($order)
      @foreach ($order as $order)
      <div class="d-flex flex-row w-75 h-100 justify-content-center border border-top-0 p-1">
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $order->created_at }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $order->name }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $order->phone }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $order->address }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:23%"><h5 class="me-1 w-100">{{ $order->order }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="ms-1 w-100">{{ $order->totalPrice }}</h5></div>
        <div class="d-flex  justify-content-center ms-1 p-1" style="width:7%"><form action="{{ route('admin.confirmOrder', $order->id) }}" method="POST" class="d-flex justify-content-center w-100">@csrf<button type="submit" class="btn btn-primary w-10 "><i class="bi bi-check-lg"></i></button></form></div>
      </div>        
      @endforeach
    @endif
  </div>

  <div class="d-flex flex-column w-100 h-100  align-items-center text-center mt-4 p-1" >
    <h5 class="bg-warning">Confirmed Orders</h5>
    @if ($confirmedOrders)
      <div class="d-flex flex-column w-100 h-100  align-items-center text-center mt-4 p-1">
  

    <div class="d-flex flex-row w-75 h-100 justify-content-center border border-primary p-1">
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Date</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Name</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Phone</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">Address</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:23%"><h5 class="me-1 w-100">Order</h5></div>
      <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">totalPrice</h5></div>
      <div class="d-flex  justify-content-center ms-1 p-1" style="width:7%"><h5 class="ms-1 w-100">Confirm</h5></div>
    </div>
    @if($order)
      @foreach ($confirmedOrders as $ordersConfirmed)
      <div class="d-flex flex-row w-75 h-100 justify-content-center border border-top-0 p-1">
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $ordersConfirmed->created_at }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $ordersConfirmed->name }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $ordersConfirmed->phone }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="me-1 w-100">{{ $ordersConfirmed->address }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:23%"><h5 class="me-1 w-100">{{ $ordersConfirmed->order }}</h5></div>
        <div class="d-flex  border-end border-secondary justify-content-center me-1 p-1" style="width:14%"><h5 class="ms-1 w-100">{{ $ordersConfirmed->totalPrice }}</h5></div>
        <div class="d-flex  justify-content-center ms-1 p-1" style="width:7%">YES</div>
      </div>        
      @endforeach
    @endif
  </div>

    @endif
  </div>
@endsection