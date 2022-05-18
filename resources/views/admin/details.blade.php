@extends('layouts.app')


@section('title')
  {{$product->name }}
@endsection

@section('content')
  <div class="d-flex flex-column  w-100 h-100 justify-content-center align-items-center">

    <div class="d-flex flex-column align-items-center w-75  h-100">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"><a href="{{ route('admin.product') }}"><i class="bi bi-backspace-fill"></i></a></th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">description</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <form class="d-flex flex-column justify-content-between w-100 p-2 " action="{{ route('admin.updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="d-flex flex-row">
                <td>{{ $product->id }}</td>
                <td><input class="d-flex form-control  " type="text" name="name" value="{{ $product->name }}"></td>
                <td><input class="d-flex form-control" type="text" name="price" value="{{ $product->price }}"></td>
                <td><input class="form-control " type="text" name="stock" value="{{ $product->stock }}"></td>
                <td><textarea class="form-control" name="description">{{ $product->description }}</textarea></td>
              </div>
          </tr>
        </tbody>
      </table>
      <div class="d-flex flex-row flex-row justify-content-center w-100 mb-4">
        <input class="d-flex btn btn-primary w-25 justify-content-center " type="submit" value="Save">
      </div>
    </form>

    <div class="d-flex flex-column w-100 justify-content-center align-items-center mt-4">
    <div class="d-flex flex-column w-75 justify-content-center  border border-secondary shadow">

      <div class="container d-flex flex-row m-2">
        <div class="d-flex w-25  flex-row justify-content-end">
          @if ($product->image->pathOne)
            <img class="m-1 border-bottom border-start border-secondary mb-0" src="{{$product->image->url($product->image->pathOne)}}" alt="" style="width:200px; height:200px;">
            @else
            <img class="m-1 border-bottom border-start border-secondary mb-0" src="..." alt="" style="width:200px; height:200px;">
          @endif
        </div>
        <form class="d-flex flex-row w-50 align-items-center border-bottom border-secondary" action="{{ route('admin.changeImage', [$product->id, 'path' =>'pathOne']) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input class="form-control w-75 ms-1" type="file" name="image">
          <button class="btn btn-primary w-25">Change</button>
        </form>
      </div>

      <div class="container d-flex flex-row m-2">
        <div class="d-flex w-25  flex-row justify-content-end">
          @if ($product->image->pathTwo)
            <img class="m-1 border-bottom border-start border-secondary mb-0" src="{{$product->image->url($product->image->pathTwo)}}" alt="" style="width:200px; height:200px;">
            @else
            <img class="m-1 border-bottom border-start border-secondary mb-0" src="..." alt="" style="width:200px; height:200px;">
          @endif
        </div>
        <form class="d-flex flex-row w-50 align-items-center border-bottom border-secondary" action="{{ route('admin.changeImage', [$product->id, 'path' =>'pathTwo']) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input class="form-control w-75 ms-1" type="file" name="image">
          <button class="btn btn-primary w-25">Change</button>
        </form>
      </div>

      <div class="container d-flex flex-row m-2">
        <div class="d-flex w-25  flex-row justify-content-end">
          @if ($product->image->pathThree)
          <img class="m-1 border-bottom border-start border-secondary mb-0" src="{{$product->image->url($product->image->pathThree)}}" alt="" style="width:200px; height:200px;">
          @else
          <img class="m-1 border-bottom border-start border-secondary mb-0" src="..." alt="" style="width:200px; height:200px;">
          @endif
        </div>
        <form class="d-flex flex-row w-50 align-items-center border-bottom border-secondary" action="{{ route('admin.changeImage', [$product->id, 'path' =>'pathThree']) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input class="form-control w-75 ms-1" type="file" name="image">
          <button class="btn btn-primary w-25" type="submit">Change</button>
        </form>
      </div>

    </div>
  </div>


    <div class="d-flex container border border-danger w-100 m-4 justify-content-center">
      <form class="d-flex w-50 justify-content-center" action="{{ route('admin.deleteProduct', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="d-flex btn btn-danger w-25 justify-content-center m-2" type="submit" value="DELETE PRODUCT">
      </form>
    </div>

    </div>


    <div class="d-flex flex-column w-100 h-100 mt-4">
      <div class="d-flex flex-row justify-content-center w-100 h-50 bg-warning">
        <h4>Reviews to this product</h4>
      </div>
      
        @foreach ($product->reviews as $review )
        <div class="container d-flex flex-column w-100 justify-content-center mb-4  bg-light p-2 rounded-3">

          <div id="AdminReviewSection" class="container d-flex flex-row align-items-center w-75  border border-primary ">
            <h6 class="d-flex w-25">{{ $review->created_at }}</h6>
            <h6 class="d-flex w-25">{{ $review->user->name }}</h6>
            <form  class="d-flex flex-row justify-content-end w-50 m-2" action="{{ route('admin.deleteReview', [$review->id, $product->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="d-flex btn btn-danger w-10" type="submit">
                <i class="bi bi-trash-fill"></i>
              </button>
            </form>
          </div>

          <div class="container d-flex flex-column w-75 border border-primary  ">
            <h5 id="AdminReviewContent" class="container d-flex w-75  p-2">
              {{ $review->review }}
            </h5>
            <i id="ReplayFormAdmin" class="bi bi-reply-fill" style="font-size: 1.2rem;">
              <form class="d-flex flex-row w-100 mb-2 ms-4" action="{{ route('admin.replayToReview', [$review->id, $product->id]) }}" method="POST">
                @csrf
                <textarea id="replayArea" class="form-control w-75 me-1" name="content" style="display: none"></textarea>
                <button id="replayAreaButton" class="btn btn-primary w-10" type="submit" style="display: none">Replay</button>
              </form>
            </i>
          </div>
          <div class="container d-flex flex-column {{ $review->replay()->exists() ? 'border-start border-bottom border-primary' : '' }}   me-0 pe-0  " style="width: 75%;">
            
            @foreach ($review->replay as $replay)

              <div id="AdminReplaySection" class="container d-flex flex-row w-100 align-items-center  mt-4 border border-primary p-2">
                <h6 class="d-flex w-25 ">Replayed to review by</h6>
                <h6 class="d-flex w-25">{{ $replay->userName }}</h6>
                <form class="d-flex flex-row justify-content-end w-50" action="{{ route('admin.deleteReplay', ['idReplay' => $replay->id, 'idProduct' => $product->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="d-flex btn btn-danger w-10 rounded-circle" type="submit">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                </form>
              </div>
              <h5 id="AdminReplayContent" class="d-flex p-2 border w-100 border-primary ">{{ $replay->content }}</h5>
            @endforeach
       
          </div>

        </div>
 

        @endforeach


    </div>

  </div>

  @if(Session::has('status'))
  <div class="d-flex w-100 h-100 justify-content-center mt-4">
    <div class="alert alert-primary w-25">{{ Session::get('status') }}</div>
  </div>
  @endif
@endsection