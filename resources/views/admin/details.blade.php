@extends('layouts.app')


@section('title')
  {{$product->name }}
@endsection

@section('content')
  <div class="d-flex flex-column  w-100 h-100 justify-content-center align-items-center">

    <div class="d-flex flex-column w-50 h-50 mt-4 border ">

      <div class="d-flex flex-row justify-content-between w-100 p-2 border-bottom">
        <div class="d-flex w-25 border-2 border-end justify-content-center">
          <a class="nav-link" href="{{ route('admin.product') }}">Back</a>
        </div>
        <div class="d-flex w-25 border-2 border-end justify-content-center m-0" >Name</div> 
        <div class="d-flex w-25 justify-content-center">Price (Lei)</div>
        <div class="d-flex w-25 border-2 border-start justify-content-center">Stock</div>
        <div class="d-flex w-25 border-2 border-start justify-content-center">Description</div>
      </div>

      <div class="d-flex flex-column">
        <form class="d-flex flex-column justify-content-between w-100 p-2 " action="{{ route('admin.updateProduct', $product->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="d-flex flex-row">
            <div class="d-flex w-25  justify-content-center">{{ $product->id }}</div>
            <input class="d-flex form-control w-25 " type="text" name="name" value="{{ $product->name }}">
            <input class="d-flex form-control w-25" type="text" name="price" value="{{ $product->price }}">
            <input class="form-control w-25" type="text" name="stock" value="{{ $product->stock }}">
            <textarea class="form-control w-25" name="description">{{ $product->description }}</textarea>
          </div>
  
          <div class="d-flex flex-row w-100  mt-3">
            <input class="d-flex btn btn-primary w-25 justify-content-center " type="submit" value="Save">
          </div>
        </form>

        <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <input class="d-flex btn btn-danger w-25 justify-content-center m-2" type="submit" value="DELETE">
        </form>
      </div>
      
    </div>

    <div class="d-flex flex-column w-100 h-100 mt-4">
      <div class="d-flex flex-row justify-content-center w-100 h-50 bg-warning">
        <h4>Reviews to this product</h4>
      </div>
      <div class="d-flex flex-column w-50">
        @foreach ($product->reviews as $review )
        <span class="d-flex flex-column  text-muted m-4  list-group-item list-group-item-primary rounded-2">
          {{ $review->created_at }}
          <div class=" m-1  list-group-item list-group-item-primary text-break">
            {{ $review->review }}

            <form  class="m-2" action="{{ route('admin.deleteReview', [$review->id, $product->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <input class="btn btn-danger" type="submit" value="Remove review">
            </form>
          </div>
        </span>
        @endforeach

      </div>
    </div>

  </div>

  @if(Session::has('status'))
  <div class="d-flex w-100 h-100 justify-content-center mt-4">
    <div class="alert alert-primary w-25">{{ Session::get('status') }}</div>
  </div>
  @endif
@endsection