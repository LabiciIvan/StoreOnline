@extends('layouts.userApp')

@section('title', 'LogIn Store Online')

@section('content')
<div class="d-flex flex-column w-100 h-100 mt-4 align-items-center">

  <div class="d-flex flex-column  h-100 mt-4" style="width: 15%">

    <h5 class="d-flex flex-row justify-content-center form-control fw-bold">Log-in your Account</h5>

    <form class="d-flex form-control flex-column align-items-center" action="{{ route('login') }}" method="POST">
      @csrf
      <label class="form-label" for="email">Email</label>
      <input id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
          <span class="invalid-feedback">
            {{ $errors->first('email') }}
          </span>
        @endif

      <label class="form-label" for="password">Password</label>
      <input id="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="text" name="password" value="{{ old('password') }}">
      @if ($errors->has('password'))
        <span class="invalid-feedback">
          {{ $errors->first('password') }}
        </span>
      @endif

      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="remember" value="{{ old('remember') ? 'checked': '' }}">
        <label for="remember">Remember Me</label>
      </div>


      <input class="btn btn-primary mt-2" type="submit" value="LogIn">

    </form>
  </div>

</div>
@endsection