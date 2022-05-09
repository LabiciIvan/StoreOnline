<div class=" d-flex flex-row justify-content-center border bg-light shadow w-100">

    <div class="d-flex flex-row justify-content-center w-75 m-2">
        <div class="m-2">
            <a class="nav-link text-dark fw-bold" href="{{ route('user.index') }}">Home</a>
        </div>
        <div class="m-2">
            <a class="nav-link text-dark fw-bold" href="{{ route('user.contact') }}">Contact</a>
        </div>
        <div class="m-2">
            @if (Session::has('product'))
                <a class="nav-link text-dark fw-bold" href="{{ route('user.viewCart') }}">Cart
                    {{ count(Session::get('product')) }} </a>
                </div>
                  @else
              <a class="nav-link text-dark fw-bold" href="{{ route('user.viewCart') }}">Cart 0</a>
          </div>
          @endif
</div>

<div class="d-flex flex-row-reverse w-25 m-2">
    @guest
        <div class="m-2 ">
            <a class="nav-link text-dark text-muted" href="{{ route('login') }}">Log-In</a>
        </div>
        <div class="m-2">
            <a class="nav-link text-dark text-muted" href="{{ route('register') }}">Register</a>
        </div>
    @else
        <div class="m-2">
            <a class="nav-link text-dark text-muted" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('formLogOut').submit();">LogOut
                {{ Auth::user()->name }}</a>

            <form id="formLogOut" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
        <div class="m-2">
            <a class="nav-link text-dark text-muted" href="{{ route('user.profile') }}">Profile</a>
        </div>
        @if (Auth::user()->role == 1)
            <div class="m-2">
                <a class="nav-link text-dark text-muted" href="{{ route('admin.product') }}">Admin</a>
            </div>
        @endif

    @endguest
</div>

</div>
