<div class="d-flex flex-row justify-content-center border">

  <div class="m-2">
    <a class="nav-link" href="{{ route('admin.product') }}">Product</a></div>
  <div class="m-2">
    <a class="nav-link" href="{{ route('admin.order') }}">Order</a></div>

    @guest
      @else

      @if (Auth::user()->role == 1)
      <div class="m-2">
        <a class="nav-link" href="{{ route('user.index') }}">Store</a>
      </div>    

      @endif

      <div class="m-2">
        <a class="nav-link text-dark text-muted" href="{{ route('user.profile') }}">Profile</a>
      </div>

      <div class="m-2">
        <a class="nav-link text-dark text-muted" href="{{ route('logout') }}" 
                onclick="event.preventDefault();document.getElementById('formLogOut').submit();">LogOut {{ Auth::user()->name }}</a>

        <form id="formLogOut" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

      </div>

  @endguest
</div>

