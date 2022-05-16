@extends('layouts.userApp')

@section('content')
  <div class="d-flex flex-row w-100 h-25 justify-content-center mt-2  p-2" >
    <div id="infoBar" class="container d-flex flex-row border bg-light w-50 p-0">
      
      <div  class="container d-flex flex-row align-items-center w-25 me-0 ">
        <a id="backButtonSearch" class="d-flex flex-row-reverse link-primary w-100 h-75 border-end border-primary fs-4 ms-2 align-items-center" href="{{ route('user.index') }}">
          <i id="backButtonIcon" class="bi bi-backspace-fill me-2" style="font-size: 2rem;"></i>
        </a>
      </div>
    
      <div class="container d-flex flex-row align-items-center w-75 ms-0">
        <h5 id="textSearch" class="d-flex flex-column align-items-center p-2 mt-1">Results based on your search</h5>
      </div>

    </div>
  </div>

<div class="d-flex w-100 h-100 justify-content-center">
  <table class="table w-25">
    <tbody>
    @foreach ($found as $item)
      <tr class=" border-primary">
        <th scope="row ">
          <a class="link-primary text-decoration-none fw-italic" href="{{ route('user.show', $item->id) }}">{{ $item->name }} </a>
        </th>
      </tr>
    @endforeach
    </tbody>
</div>
@endsection