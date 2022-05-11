@extends('layouts.userApp')

@section('content')
  <div class="d-flex flex-row w-100 h-25 justify-content-center align-items-center mt-2 bg-light shadow p-2" >
      <h4 class="d-flex flex-row-reverse border-2 border-end border-warning p-2 me-2 w-50 h-50">Results based on your search</h4>
      <div class="d-flex w-50 h-50">
        <a class="link-primary h-100 fs-4" href="{{ route('user.index') }}">
          {{-- back --}}
          <i class="bi bi-backspace" style="font-size: 2rem;"></i>
        </a>
      </div>
  </div>

  <div class="d-flex w-100 h-100 justify-content-center">
    <table class="table w-25">

      <tbody>
        @foreach ($found as $item)
        <tr class=" border-primary">
          <th scope="row"><a class="link-primary fw-italic" href="{{ route('user.show', $item->id) }}">{{ $item->name }} </a></th>
        </tr>
          @endforeach
      </tbody>
  </div>
@endsection