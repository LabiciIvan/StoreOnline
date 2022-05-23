@extends('layouts.userApp')

@section('title' , 'Online Shop')

@section('content')

  <div class="d-flex flex-column w-100 h-100 ">
      
    <div class="d-flex flex-column w-100 h-25 justify-content-center mt-2 bg-light shadow p-2" >

      <div class="d-flex w-100 flex-row justify-content-end" style="height: 50px;">
        @if (Session::has('status'))

          <h4 class="alert alert-success h-100 w-25 me-2 d-flex justify-content-center align-items-center"> {{  Session::get('status') }}</h4>  

        @elseif (Session::has('outStock'))  

          <h4 class="alert alert-danger w-25 me-2 justify-content-center"> {{  Session::get('outStock') }}</h4>  

        @else 
          {{-- @if($errors->has('name'))
            {{ $errors->first('name') }}
          @endif --}}
          <h4 class="d-flex w-25 flex-row-reverse me-2 align-items-center border-2 border-end border-warning p-2">Welcome to Store-Online</h4>

        @endif
        <div class="d-flex w-50 flex-column">

          <form class="ms-2 w-100 d-flex flex-row" role="search" action="{{ route('user.searchForProducts') }}" method="POST">
            @csrf
            @method('GET')
            <input class="form-control w-25 me-2 {{ $errors->has('name') ? ' is-invalid' : '' }}"  type="text" name="name">
            {{-- @if ($errors->has('name'))
              <span class="invalid-feedback">
                <strong>
                  {{ $errors->first('name') }}
                </strong>
              </span>
            @endif --}}
            {{-- <input class="btn btn-warning w-25 fw-bold" type="submit" value="Search"> --}}
            <button class="btn btn-warning fw-bold" type="submit">
                <i id="searchLogo" class="bi bi-search"></i>
            </button>
            

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex  w-100 h-100 mt-4 justify-content-center">
    @if($products)
      <div class="d-flex w-75 h-100 flex-wrap mt-4 border-3 border-start border-warning ">
        @foreach ($products as $product )
        <div id="product" class="d-flex flex-column border m-4 bg-light rounded-1  p-1 " style="width:170px; height:315px;">
          <a class="d-flex flex-column align-items-center w-100 text-decoration-none" style="height: 270px;" href="{{ route('user.show', $product['id']) }}">
            <div class="d-flex flex-column align-items-center justify-content-center w-100 " style="height: 220px;">
              @if($product->image()->exists())
              <img id="imageIndex" class="" src="{{ Storage::disk('s3')->url($product->image->pathOne) }}" alt="" style="height: 220px;" width="160px;">
              @endif
            </div>
            <div class="d-flex " style="height: 25px">
              {{ $product->name }}
            </div>
            <div class="d-flex flex-row ustify-content-center "style="height: 25px">
              {{ $product->price }}
              <h4>Lei</h4>
            </div>
          </a>
          <form class="d-flex flex-row justify-content-center w-100 mt-1 " style="height: 30px" action="{{ route('user.index.addCart', $product->id) }}" method="POST">
            @csrf
            <input class="btn btn-warning w-100 h-100 text-white fw-bold" type="submit" value="Add Cart">
          </form>
        </div>

        @endforeach
      </div>
    @endif
  </div>
@endsection