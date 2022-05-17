@extends('layouts.app')

@section('title', 'Admin Product')

@section('content')
  

  <div class="d-flex flex-column align-items-center">

    <div class="d-flex justify-content-center flex-column border border-bottom-0 w-50 h-50 mt-4">
        <h2 class="d-flex justify-content-center border-bottom fw-light">Products in Store</h2>

        <div class="d-flex flex-row">
          <div class="d-flex flex-row justify-content-between w-100 p-2 border-bottom">
            <div class="d-flex w-25 border-2 border-end justify-content-center">ID</div>
            <div class="d-flex w-25 border-2 border-end justify-content-center m-0" >Name</div> 
            <div class="d-flex w-25 justify-content-center">Price (Lei)</div>
            <div class="d-flex w-25 border-2 border-start justify-content-center">Stock</div>
          </div>
        </div>
        @if($products)
          @foreach ($products as $product )
          <div class="d-flex flex-row">
            <div class="d-flex flex-row justify-content-between w-100 p-2 border-bottom">
              <div class="d-flex w-25 border-2 border-end justify-content-center">{{ $product->id }}</div>
              <div class="d-flex w-25 border-2 border-end justify-content-center m-0" >
                <a href="{{route('admin.productDetails', $product->id)}}">{{ $product->name }}</a>
              </div> 
              <div class="d-flex w-25 justify-content-center">{{ $product->price }}</div>
              @if($product->stock == 0)
                <div class="d-flex w-25 border-2 border-start justify-content-center bg-warning">{{ $product->stock }}</div>
              @else
                <div class="d-flex w-25 border-2 border-start justify-content-center">{{ $product->stock }}</div>
              @endif
            </div>
          </div>
          @endforeach
        @endif
    </div>

    <div class="d-flex flex-column align-items-center border w-50 h-50 mt-4">
      <h2 class="d-flex justify-content-center border-bottom mb-2 p-2 w-100">Add products in Store</h2>

        <form class="d-flex flex-column w-50" action="{{ route('admin.addProduct') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <label class="form-label" for="name">Name</label>
          <input class="form-control bg-white mb-2" type="text" name="name" id="name" value="{{ old('name') }}">

          <label class="form-label" for="price">Price</label>
          <input class="form-control bg-white mb-2" type="text" name="price" id="price" value="{{ old('price') }}">

          <label class="form-label" for="stock">Stock</label>
          <input class="form-control bg-white mb-2" type="text" name="stock" id="stock" value="{{ old('stock') }}">

          <label for="imageOne">imageOne</label>
          <input type="file" id="imageOne" name="imageOne" class="form-control">

          <label for="imageTwo">imageTwo</label>
          <input type="file" id="imageTwo" name="imageTwo" class="form-control">

          <label for="imageThree">imageThree</label>
          <input type="file" id="imageThree" name="imageThree" class="form-control">

          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control mb-2"></textarea>
          
          <input class="btn btn-primary mb-2" type="submit">
        </form>
        @if($errors->any())
          @foreach ($errors->all() as  $error)
            <div>{{ $error }}</div>
          @endforeach
        @endif
    </div>

  </div>
@endsection