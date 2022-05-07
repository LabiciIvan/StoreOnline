@extends('layouts.userApp')


@section('title')
    {{ $product['name'] }}
@endsection

@section('content')
    <div class="d-flex flex-column w-100 h-100 mt-4">

        <div class="d-flex flex-row w-100 h-10 justify-content-between mt-2 bg-light shadow p-2">
            <a class="d-flex flex-row w-25 border-2 border-end justify-content-center btn btn-link"
                href="{{ route('user.index') }}">Back</a>

            <div class="d-flex w-75 flex-row ms-4 align-items-center">
                <h4>{{ $product['name'] }}</h4>
            </div>
        </div>

        <div class="d-flex flex-row w-100 h-100 mt-4 justify-content-center">

            <div class="d-flex flex-row justify-content-center w-50  m-3 shadow bg-light rounded-2">
                <div class="d-flex justify-content-center bg-warning w-75  align-items-center">
                    <img class="d-flex w-75 h-75  justify-content-center" src="" alt="Can't display image ">
                </div>
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

    <div class="d-flex flex-column w-100 h-100 mt-4 align-items-center">

        <div class="d-flex w-100 h-100 justify-content-center">
            <h4 class="d-flex  w-75 justify-content-center  bg-light rounded-1 shadow">Description</h4>
        </div>

        <div class="d-flex flex-row flex-wrap w-25 h-50">
            <h4>{{ $product->description }}</h4>
        </div>
    </div>

    <div class="d-flex flex-column w-100 h-100 mt-4 align-items-center">

        <div class="d-flex w-100 h-100 justify-content-center">
            <h4 class="d-flex  w-75 justify-content-center  bg-light rounded-1 shadow">Reviews</h4>
        </div>

        <div class="d-flex flex-column align-items-center w-75 h-100 border-start border-warning border-2 ">

            <div class="d-flex flex-column w-100 h-100 ">
                @foreach ($product->reviews as $review)
                    <ul class="list-group m-4 w-25">

                        <li class="list-group-item list-group-item-primary w-100">
                            <span class="d-flex flew-row-reverse text-muted">{{ $review->created_at }} by
                                {{ $review->user->name }}</span>
                        <li class="container d-flex list-group-item list-group-item-primary w-100 text-break">
                          {{ $review->review }}
                        </li>
                        </li>

                    </ul>
                @endforeach
                    {{-- @guest
                    @else --}}
                <form class="d-flex justify-content-center w-50 m-4  bg-light rounded-2 shadow p-2"
                    action="{{ route('user.review', $product['id']) }}" method="POST">
                    @csrf
                    <textarea class="m-1 form-control w-100" name="review"></textarea>
                    <input class="btn btn-primary m-2" type="submit" value="Add review">
                </form>
                {{-- @endguest --}}
            </div>

        </div>
    </div>
@endsection
