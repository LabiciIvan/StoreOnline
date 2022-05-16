
<div >
    <div class=" d-flex flex-row justify-content-center border bg-light shadow w-100">

        <div class="d-flex flex-row justify-content-center w-75 m-2">
            <div class="m-2">
                <a class="d-flex align-items-center nav-link text-dark fw-bold" href="{{ route('user.index') }}"  style="font-size: 1.2rem;" >Home</a>
            </div>
            <div class="m-2">
                <a class="nav-link text-dark fw-bold" href="{{ route('user.contact') }}"  style="font-size: 1.2rem;" >Contact</a>
            </div>
            <div class="m-2">
                @if (Session::has('product') && count(Session::get('product')) > 0 )
                    <a class="nav-link text-dark fw-bold" href="{{ route('user.viewCart') }}">
                        
                        <i class="bi bi-cart-check " style="font-size: 1.2rem;"></i>
                    
                        {{ count(Session::get('product')) }} 
                    </a>
                    </div>
                    @else
                <a class="nav-link text-dark fw-bold" href="{{ route('user.viewCart') }}"  style="font-size: 1.2rem;">
                    <i class="bi bi-cart" ></i>
                </a>
            </div>
            @endif
    </div>

    <div class="d-flex flex-row-reverse w-75 m-2">
        @guest
            <div class="m-2 ">
                <a class="nav-link text-dark text-muted" href="{{ route('login') }}">Log-In</a>
            </div>
            <div class="m-2">
                <a class="nav-link text-dark text-muted" href="{{ route('register') }}">Register</a>
            </div>
        @else
            <div class="m-2">
                <a class="nav-link text-dark text-muted " href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('formLogOut').submit();">

                    <i class="bi bi-door-open-fill" >
                    
                    </i>
                    {{ Auth::user()->name }}
                </a>

                <form id="formLogOut" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
            <div class="m-2">
                <a class="nav-link text-dark text-muted" href="{{ route('user.profile') }}">
                    <i class="bi bi-person-fill m-0" style="font-size: 1.1rem"></i>

                    Profile
                </a>
            </div>
            @if (Auth::user()->role == 1)
                <div class="m-2">
                    <a class="nav-link text-dark text-muted" href="{{ route('admin.product') }}">
                        <i class="bi bi-person-lines-fill" style="font-size: 1.1rem"></i>    
                        Admin
                    </a>
                </div>
            @endif

        @endguest
    </div>

</div>
