@extends('layouts.userApp')

@section('title' , 'Online Shop')

@section('content')

@php
 use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\Storage;
@endphp
  
<div class="sub-navigation-bar">
  <div class="sub-navigation-bar-info">    
    @if (Session::has('status'))
    <h4> {{  Session::get('status') }}</h4>  
    @elseif (Session::has('outStock'))  
    <h4 > {{  Session::get('outStock') }}</h4>  
    @else 
    <h4>Welcome to Store-Online</h4>
  @endif
  </div>
  <form class="search-form" role="search" action="{{ route('user.searchForProducts') }}" method="POST">
    @csrf
    @method('GET')
    <input class="search-form-input {{ $errors->has('name') ? ' is-invalid' : '' }}"  type="text" name="name">
    <button class="search-form-button" type="submit">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </form>

</div>

<div class="product-window">
  <div class="products-holder">

    @if($products)
      @foreach ($products as $product )
      <div class="product">
        <a class="product-image" href="{{ route('user.show', $product['id']) }}">
          @if($product->imag()->exists())
            <img class="product-image-source" src="{{ Storage::disk('s3')->url($product->imag->pathOne); }}">
          @endif
        </a>
        <div class="product-description">
          <div> {{ $product->name }}</div>
          <div> {{ $product->price }}</div>
        </div>
        <div class="product-addCart">
          <form class="form-addCart" action="{{ route('user.index.addCart', $product->id) }}" method="POST">
            @csrf
            <button class="product-addCart-button" type="submit">Add to Cart</button>
          </form>
        
        </div>
      </div>
      @endforeach
    @endif

  </div>
</div>
@endsection