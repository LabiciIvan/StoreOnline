@php
 use Illuminate\Support\Facades\Session;
 use Illuminate\Support\Facades\Auth;
@endphp

<div class="navigation-bar">
    <div class="navigation-bar-link">
        <div class="navigation-bar-link-content">
            <a class="navigation-bar-link-content-link" href="{{ route('user.index') }}">HOME</a>
        </div>
        <div class="navigation-bar-link-content">
            <a class="navigation-bar-link-content-link" href="{{ route('user.contact') }}">Contact</a>
        </div>
        <div class="navigation-bar-link-content">
            <a class="navigation-bar-link-content-link" href="{{ route('user.viewCart') }}">
             @if (Session::has('product') && count(Session::get('product')) > 0 )
                <i class="fa-solid fa-cart-shopping"></i>{{ count(Session::get('product')) }}
                @else
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
             @endif
        </div>
    </div>

    <div class="navigation-bar-action">
        @guest
        <div class="navigation-bar-action-content">
            <a class="navigation-bar-action-content-link" href="{{ route('register') }}">Register</a>
        </div>
        <div class="navigation-bar-action-content">
            <a class="navigation-bar-action-content-link" href="{{ route('login') }}">Log-in</a>
        </div>
        @else
        @if (Auth::user()->role == 1)
        <div class="navigation-bar-action-content">
            <a class="navigation-bar-action-content-link" href="{{ route('admin.product') }}">Admin</a>
        </div>
        @endif
        <div class="navigation-bar-action-content">
            <a class="navigation-bar-action-content-link" href="{{ route('user.profile') }}">Profile</a>
        </div>
        <div class="navigation-bar-action-content">

            <a class="navigation-bar-action-content-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('formLogOut').submit();">
                {{ Auth::user()->name }}
            </a>
            <form id="formLogOut" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        @endguest
    </div>

</div>

