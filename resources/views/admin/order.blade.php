@extends('layouts.app')

@section('title', 'Admin Order')

@section('content')
  <div class="d-flex flex-column w-100 h-100  align-items-center text-center mt-4 p-1">
    <h5 class="bg-warning">Placed Orders</h5>

    <table class="table table-hover w-75 m-1">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Order</th>
          <th scope="col">Total Price</th>
          <th scope="col">Payment</th>
          <th scope="col">Confirm</th>
        </tr>
      </thead>
      <tbody>
        @if ($order)
          @foreach ($order as $order )
          <tr>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->order }}</td>
            <td>{{ $order->totalPrice }}</td>
            <td>{{ $order->payment }}</td>
            <td><form action="{{ route('admin.confirmOrder', $order->id) }}" method="POST" class="d-flex justify-content-center w-100">@csrf<button type="submit" class="btn btn-primary w-10 "><i class="bi bi-check-lg"></i></button></form></td>
          </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>

  <div class="d-flex flex-column w-100 h-100  align-items-center text-center mt-4 p-1" >
    <h5 class="bg-warning">Confirmed Orders</h5>

    <table class="table table-hover w-75">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Order</th>
          <th scope="col">Total Price</th>
          <th scope="col">Payment</th>
        </tr>
      </thead>
      <tbody>
        @if ($confirmedOrders)
          @foreach ($confirmedOrders as $ordersConfirmed )
          <tr>
            <td>{{ $ordersConfirmed->created_at }}</td>
            <td>{{ $ordersConfirmed->name }}</td>
            <td>{{ $ordersConfirmed->phone }}</td>
            <td>{{ $ordersConfirmed->address }}</td>
            <td>{{ $ordersConfirmed->order }}</td>
            <td>{{ $ordersConfirmed->totalPrice }}</td>
            <td>{{ $ordersConfirmed->payment }}</td>
          </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
@endsection