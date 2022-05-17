@extends('layouts.userApp')


@section('title')
    {{ $product['name'] }}
@endsection

@section('content')
    <div class="d-flex flex-column w-100 h-100 mt-4">

        <div class="d-flex flex-row w-100 h-25 justify-content-center mt-1" >
            <div id="infoBar" class="container d-flex flex-row border bg-light w-75 p-0">
              
              <div  class="container d-flex flex-row align-items-center w-25 me-0 ">
                <a id="backButtonSearch" class="d-flex flex-row-reverse link-primary w-100 h-75 border-end border-primary fs-4 ms-2 align-items-center" href="{{ route('user.index') }}">
                  <i id="backButtonIcon" class="bi bi-backspace-fill me-2" style="font-size: 2rem;"></i>
                </a>
              </div>
            
              <div class="container d-flex flex-row align-items-center w-75 ms-0">
                <h5 id="textSearch" class="d-flex flex-column align-items-center p-2 mt-1">{{ $product['name'] }}</h5>
              </div>
        
            </div>
          </div>

        <div class="d-flex flex-row w-100 h-100 mt-4 justify-content-center">
            <img src="storage/products/g1xZFLAx2m3ZCiNtECq3jvaQHJ5bqMlbwybFciky.jpg" alt="">

            <div class="d-flex justify-content-center w-50  m-3 shadow  rounded-2">
            @include('user.slideShow')
            </div>

            <div class="d-flex flex-column w-25 m-3 shadow bg-light align-items-center justify-content-center rounded-2"
                style="height: 400px;">

                <div class="d-flex flex-column w-100 h-75 align-items-center">

                    <div class="d-flex flex-column w-100 h-50  justify-content-center border-bottom ms-4">
                        <div class="d-flex flex-row w-100 align-items-center">
                            <h4>{{ $product['name'] }}</h4>
                            <h5 class="ms-4">{{ $product['price'] }} Lei</h5>
                        </div>
                        <h5 class="text-muted">reviews {{ $reviews->reviews_count }}</h5>
                        <h5>Store-Online</h5>
                    </div>

                    <div class="d-flex flex-row justify-content-center align-items-center w-100 h-50 border-bottom">

                        <h6 class="alert alert-primary">{{ $product['stock'] }} <h5 class="ms-2">Available in
                                Store</h5>
                        </h6>

                    </div>
                </div>

                <div class="d-flex w-100 h-25 justify-content-center align-items-center">
                    <form class="d-flex flex-column justify-content-center h-50 w-100 align-items-center"
                        action="{{ route('user.show.addCart', $product->id) }}" method="POST">
                        @csrf
                        @if (Session::has('status'))
                            <div class="d-flex align-items-center alert alert-success h-25">{{ Session::get('status') }}
                            </div>
                        @elseif(Session::has('outStock'))
                            <div class="d-flex align-items-center alert alert-danger h-25">{{ Session::get('outStock') }}
                            </div>
                        @endif
                        <input class="btn btn-warning w-50 text-white fw-bold" type="submit" value="Add cart">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="d-flex flex-column w-100 h-100 mt-4 align-items-center ">

        <div class="d-flex flex-row w-75 h-100 align-items-center justify-content-center border border-warning bg-light shadow-sm  p-2">
            <h2 class="d-flex flex-column w-25 bg-warning align-items-center h-50 mb-0 text-white fw-bold">Description</h2>
        </div>

        <div class="d-flex flex-row flex-wrap w-75 h-50 border-start border-warning justify-content-center">
            <h4 id="descriptionProduct" class="container w-50 mt-2 p-2">{{ $product->description }}</h4>
        </div>
    </div>

    <div class="d-flex flex-column w-100 h-100 mt-4 align-items-center">
    
        <div class="d-flex flex-row w-75 h-100 align-items-center justify-content-center border border-warning bg-light shadow-sm  p-2">
            <h2 class="d-flex flex-column w-25 bg-warning align-items-center h-50 mb-0 text-white fw-bold">Reviews</h2>
        </div>

        <div class="d-flex flex-column align-items-center w-75 h-100 border-start border-warning border-2 p-2 ">

            <div class="d-flex flex-column w-100 h-100 rounded-2 " >
                @foreach ($product->reviews as $review)
                    <ul id="allForm" class="list-group m-4 w-50 ">
                        <li class="list-group-item list-group-item-primary w-100">
                            <span class="d-flex flex-row text-muted  w-100">
                                <div class="d-flex  align-items-center p-1" style="width: 80%;">

                                    {{ $review->created_at }} _
                                    {{ $review->user->name }}

                                </div>
                                @if(Auth::check() && Auth::user()->id == $review->user_id)
                                    <form class="d-flex justify-content-end " action="{{ route('user.removeReview', [$review->id, $product->id]) }}" method="POST" style="display: none; width: 20%;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-decoration-none w-25 h-100 text-muted" type="submit">
                                            <i class="bi bi-trash text-primary"></i>
                                        </button>
                                    </form>
                                @endif
                            </span>

                            <li class="container d-flex list-group-item list-group-item-primary w-100 text-break">
                                {{ $review->review }}
                            </li>
                            
                            <ul class="list-group border-start border-bottom border-primary ms-2 rounded-0">
                                {{-- @if ($product->replay) --}}
                                    @foreach ($review->replay as $response )
                                        <li class="d-flex flex-row w-90 list-group-item list-group-item-primary ms-4 mt-1 text-muted rounded-1">
                                            <div class="d-flex flex-row" style="width: 90%;">
                                                {{ $response->created_at }} _
                                                @if ($response->userName == 'ADMIN')
                                                 <i class="bi bi-file-person"></i>{{ $response->userName }}
                                                @else
                                                {{ $response->userName }} 
                                                @endif
                                            </div>
                                            
                                            @if (Auth::check() && Auth::user()->id == $response->user_Id)
                                            <form class="d-flex justify-content-end" action="{{ route('user.deleteReplay', [$response->id, $product->id] ) }}" method="POST" style="display: none; width: 10%;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link text-decoration-none w-50 h-100 text-muted" type="submit">
                                                    <i class="bi bi-trash text-primary"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </li>
                                        <li class="list-group-item list-group-item-primary ms-4 mb-1">
                                            {{ $response->content }}
                                            
                                        </li>
                                    @endforeach
                                    
                                {{-- @endif --}}
                                
                                @if (Auth::check())  
                                                   
                                <i id="replayForm" class="bi bi-reply-fill d-flex w-80 ms-4 mb-1" style="font-size: 1rem;" >
                                    <form  class="d-flex w-100 ms-4 mb-1" action="{{ route('user.reviewReplay', [$review->id, $product->id]) }}" method="POST">
                                        @csrf
                                        <textarea id="replayArea" class="form-control me-1 shadow {{  $errors->has('content') ? ' is-invalid' : '' }}"  name="content" id="" style="width: 90%; display:none;"></textarea>
                                        {{-- @if($errors->has('content'))
                                            <strong>
                                                {{ $errors->first('content') }}
                                            </strong>
                                        @endif --}}
                                        <button id="replayAreaButton" class="btn btn-primary shadow" style="width: 10%; display:none;">replay</button>
                                    </form>
                                </i>
                                @endif
                            </ul>

                            
                        </li>
                    </ul>

                @endforeach
                @guest
                    <div class="d-flex flex-row justify-content-between align-items-center border border-warning  bg-secondary rounded-2 w-50 h-100 ms-4 mb-1">
                        <div class="d-flex  w-75 flex-row justify-content-center h-100 text-white">You must log-in to add a review.</div>
                        <a class="btn btn-warning text-white fw-bold rounded-0 w-25 h-100" href="{{ route('login') }}">
                            <i class="bi bi-person-fill w-25"> Log-In</i>
                        </a>
                    </div>
                @else

                <div class="d-flex flex-row list-group-item-primary  w-50 m-4  rounded-2 shadow p-1">
                    <i id="reviewForm" class="bi bi-reply-all-fill w-100 flex column ms-2" style="font-size: 1.2rem;">
                        write a review
                        <form  class="d-flex justify-content-center list-group-item-primary  w-100"
                        action="{{ route('user.review', $product['id']) }}" method="POST">
                        @csrf
                        <textarea id="reviewArea" class="m-1 form-control w-100" name="review" style="display: none"></textarea>
                        <button id="reviewButton" class="btn btn-primary  m-2"  style="display: none">
                            Add review
                        </button>

                    </form>
                    </i> 
                </div>
                @endguest
            </div>

        </div>
    </div>
@endsection
