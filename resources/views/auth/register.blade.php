@extends('layouts.userApp')

@section('title', 'Register to Store Online')

@section('content')
<div class="d-flex flex-column w-100 h-100 mt-4 align-items-center">

  <div class="d-flex flex-column  h-100 mt-4" style="width: 15%">

    <h5 class="d-flex flex-row justify-content-center form-control fw-bold">Register your Account</h5>

    <form class="d-flex form-control flex-column align-items-center" action="{{ route('register') }}" method="POST">
      @csrf
      <label class="form-label" for="name">Name</label>
      <input id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
            <span class="invalid-feedback">
                {{ $errors->first('name') }}
            </span>
        @endif

      <label class="form-label" for="email">Email</label>
      <input id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
        <span class="invalid-feedback">
            {{ $errors->first('email') }}
        </span>
        @endif

      <label class="form-label" for="password">Password</label>
      <input id="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="text" name="password">
        @if ($errors->has('password'))
        <span class="invalid-feedback">
            {{ $errors->first('password') }}
        </span>
        @endif

      <label class="form-label" for="passwordR">Repeat Password</label>
      <input id="passwordR" class="form-control" type="text" name="password_confirmation">

      <label class="form-label" for="phone">Phone</label>
      <input id="passwordR" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="text" name="phone">

      <label class="form-label" for="street">Street</label>
      <input id="passwordR" class="form-control {{ $errors->has('street') ? ' is-invalid' : '' }}" type="text" name="street">

      <label class="form-label" for="country">Country</label>
      <input id="passwordR" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" type="text" name="country">

      <input class="btn btn-primary mt-2" type="submit" value="Register">

    </form>
  </div>

</div>
@endsection