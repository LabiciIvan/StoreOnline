@extends('layouts.userApp')

@section('title', 'Shopping Cart')

@section('content')

<div class="d-flex flex-row w-100 h-100 justify-content-center p-2 mt-4">

  <div class="d-flex flex-column w-25 h-100 m-2 p-2 bg-light rounded-2">
    <a class="btn btn-primary w-25 m-2" href="{{ route('user.profile') }}">Profile</a>
    <a class="btn btn-primary w-25 m-2" href="{{ route('user.history') }}">History</a>
  </div>

  <div class="d-flex flex-column w-50 h-100 m-2 bg-light rounded-2">
    <div class="d-flex flex-column w-100 h-100 m-2  p-2 rounded-2">

  
      <form class="d-flex flex-column align-items-center w-50 h-100 p-2" action="{{ route('user.updateProfile') }}" method="POST">
        @csrf
        @method('PUT')
        <label class="form-label mt-2" for="phone">Phone</label>
        <input class="form-control  {{ $errors->has('phone') ? ' is-invalid': '' }}" id="phone" class="form-control w-25" type="text" name="phone" value="{{ Auth::user()->profile->phone }}">
          @if ($errors->has('phone'))
            <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
          @endif


        <label class="form-label mt-2" for="street">Street</label>
        <input class="form-control  {{ $errors->has('street') ? ' is-invalid': '' }}" id="street" class="form-control w-25" type="text" name="street" value="{{ Auth::user()->profile->street }}">
          @if ($errors->has('street'))
          <span class="invalid-feedback">{{ $errors->first('street') }}</span>
          @endif


        <label class="form-label mt-2" for="country">Country</label>
        <input class="form-control  {{ $errors->has('country') ? ' is-invalid': '' }}" id="country" class="form-control w-25" type="text" name="country" value="{{ Auth::user()->profile->country }}"> 
          @if ($errors->has('country'))
          <span class="invalid-feedback">{{ $errors->first('country') }}</span>
          @endif


        <input class="btn btn-warning text-light mt-4" type="submit" value="Save changes">
      </form>
  
    </div>

  </div>
</div>

@endsection