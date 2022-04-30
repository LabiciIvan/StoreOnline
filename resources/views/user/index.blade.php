@extends('layouts.userApp')

@section('title' , 'Online Shop')

@section('content')

  <div class="d-flex flex-column w-100 h-100 mt-4">
      
    <div class="d-flex flex-row w-100 h-10 justify-content-center mt-2 bg-light shadow p-2">

      <div class="d-flex w-75 flex-row justify-content-center">
        @if (Session::has('status'))

          <h4 class="alert alert-success "> {{  Session::get('status') }}</h4>  

        @elseif (Session::has('outStock'))  

        <h4 class="alert alert-danger"> {{  Session::get('outStock') }}</h4>  

        @else 

          <h4>Welcome to Store-Online</h4>

        @endif
      </div>
    </div>
  </div>

  <div class="d-flex  w-100 h-100 mt-4 justify-content-center">
    @if($products)
      <div class="d-flex w-75 h-100 flex-wrap mt-4 border-3 border-start border-warning ">
        @foreach ($products as $product )
        <div class="d-flex flex-column border m-4 bg-light rounded-1 shadow " style="width:170px; height:300px;">
          <a class="d-flex flex-column align-items-center w-100" style="height: 270px;" href="{{ route('user.show', $product['id']) }}">
            <div class="d-flex flex-column align-items-center justify-content-center w-100" style="height: 220px;">
              Image
            </div>
            <div class="d-flex " style="height: 25px">
              {{ $product->name }}
            </div>
            <div class="d-flex flex-row ustify-content-center "style="height: 25px">
              {{ $product->price }}
              <h4>Lei</h4>
            </div>
          </a>
          <form class="d-flex flex-row justify-content-center w-100" style="height: 30px" action="{{ route('user.index.addCart', $product->id) }}" method="POST">
            @csrf
            <input class="btn btn-warning w-100 h-100 text-white fw-bold" type="submit" value="Add Cart">
          </form>
        </div>

        @endforeach
      </div>
    @endif
  </div>
@endsection